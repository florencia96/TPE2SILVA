<?php

class TripModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_viajes;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de viajes completa.
     */
    public function getAll() {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM viaje");
        $query->execute();

        // 3. obtengo los resultados
        $trips = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $trips;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM viaje WHERE id_viaje = ?");
        $query->execute([$id]);
        $trip = $query->fetch(PDO::FETCH_OBJ);
        
        return $trip;
    }

    /**
     * Inserta un viaje en la base de datos.
     */
    public function insert($origen, $destino, $fecha, $salida, $llegada, $precio) {
        $query = $this->db->prepare("INSERT INTO viaje (origen, destino, fecha, salida, llegada, precio) VALUES (?, ?, ?, ?, ?, ?)");
        $query->execute([$origen, $destino, $fecha, $salida, $llegada, $precio]);

        return $this->db->lastInsertId();
    }


    /**
     * Elimina un viaje dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM viaje WHERE id_viaje = ?');
        $query->execute([$id]);
    }

    
}
