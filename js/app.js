"use strict"

const URL = "api/trips/";

let trips = [];

let form = document.querySelector('#trip-form');
form.addEventListener('submit', insertTrip);


/**
 * Obtiene todos los viajes de la API REST
 */
async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        trips = await response.json();

        showTrips();
    } catch(e) {
        console.log(e);
    }
}

/**
 * Inserta el viaje via API REST
 */
async function insertTrip(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let trip = {
        origen: data.get('origen'),
        destino: data.get('destino'),
        fecha: data.get('fecha'),
        salida: data.get('salida'),
        llegada: data.get('llegada'),
        precio: data.get('precio'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(trip)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nTrip = await response.json();

        // inserto el viaje nuevo
        trips.push(nTrip);
        showTrips();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteTrip(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.trip;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar el viaje del arreglo global
        trips = trips.filter(trip => trip.id != id);
        //showTrips();
    } catch(e) {
        console.log(e);
    }
}

function showTrips() {
    let ul = document.querySelector("#trip-list");
    ul.innerHTML = "";

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteTrip);
    }
}

getAll();