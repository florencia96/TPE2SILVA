<?php
require_once './app/models/trip.model.php';
require_once './app/views/api.view.php';
require_once './app/helpers/auth-api.helper.php';

class TripApiController {
    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
        $this->model = new TripModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getTrips($params = null) {
        $trips = $this->model->getAll();
        $this->view->response($trips);
    }

    public function getTrip($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $trip = $this->model->get($id);

        // si no existe devuelvo 404
        if ($trip)
            $this->view->response($trip);
        else 
            $this->view->response("El viaje con el id=$id no existe", 404);
    }

    public function deleteTrip($params = null) {
        $id = $params[':ID'];
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }


        $trip = $this->model->get($id);
        if ($trip) {
            $this->model->delete($id);
            $this->view->response($trip);
        } else 
            $this->view->response("El viaje con el id=$id no existe", 404);
    }

    public function insertTrip($params = null) {

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }
        
        $trip = $this->getData();

        if (empty($trip->origen) || empty($trip->destino) || empty($trip->fecha) || empty($trip->salida) || empty($trip->llegada) || empty($trip->precio)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($trip->origen, $trip->destino, $trip->fecha, $trip->salida, $trip->llegada, $trip->precio);
            $trip = $this->model->get($id);
            $this->view->response($trip, 201);
        }
    }

}