<?php
require_once './libs/Router.php';
require_once './app/controllers/trip-api.controller.php';
require_once './app/controllers/auth-api.controller.php';
require_once './app/controllers/apiComentarioController.php';
require_once './app/models/comentariosModel.php';

// crea el router
$router = new Router();



// defina la tabla de ruteo
$router->addRoute('trips', 'GET', 'TripApiController', 'getTrips');
$router->addRoute('trips/:ID', 'GET', 'TripApiController', 'getTrip');
$router->addRoute('trips/:ID', 'DELETE', 'TripApiController', 'deleteTrip');
$router->addRoute('trips', 'POST', 'TripApiController', 'insertTrip'); 

$router->addRoute("auth/token", 'GET', 'AuthApiController', 'getToken');

//api comentarios
$router->addRoute('comentarios', 'GET', 'apiComentarioController', 'getComentarios');
$router->addRoute('comentarios/:ID', 'GET', 'apiComentarioController', 'getComentario');
$router->addRoute('comentarios', 'POST', 'apiComentarioController', 'insertComentario');
$router->addRoute('comentarios/:ID', 'DELETE', 'apiComentarioController', 'deleteComentario');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);