<?php
require_once "./App/Model/sellersModel.php";
require_once "./App/View/apiView.php";

class apiSellersController {
    private $model;
    private $view;

    public function __construct(){
        $this->model = new sellersModel();
        $this->view = new apiView();
    }


    public function getAll(){
        if(isset($_GET['order'])&&$_GET['order']=="asc"){
            $sellers = $this->model->getSellersOrderAsc();
        }else if(isset($_GET['order'])&&$_GET['order']=="desc"){
            $sellers = $this->model->getSellersOrderDesc();
        }else{
            $sellers = $this->model->getSellers();
        }
        $this->view->response($sellers, 200);
    }

    public function getOne($params = null){
        $id = $params[":ID"];
        $seller = $this->model->getSeller($id);
        if($seller){
            $this->view->response($seller, 200);
        }else{
            $this->view->response("Error $id no existe", 404);
        }
       
    }
    public function remove($params = null){
        $id = $params[":ID"];
        $seller = $this->model->getSeller($id);

        if($seller){
            $this->model->deleteSellerFromDB($id);
            $this->view->response("Se elimino con exito", 200);
        }else{
            $this->view->response("Error $id no existe", 404);
        }
    }
    public function insert($params = null){
        $body = $this->getBody();
        $id = $this->model->insertSeller($body->id_vendedor, $body->nombre, $body->legajo);
        if($id != 0){
            $this->view->response("No se pudo insertar con exito", 500);
        }
        else{
            $this->view->response("Se inserto con exito id", 200 );
        }
        
        
    }
    private function getBody(){
        $bodyString = file_get_contents("php://input"); 
        return json_decode($bodyString);
    }

    public function update($params = null){
        $id = $params[":ID"];
        $body = $this->getBody();
        $seller = $this->model->getSeller($id);

        if($seller){
            $this->model->updateSellerFromDB($body->nombre, $body->legajo, $id);
            $this->view->response("Se actualizo con exito id=$id", 200);
        }else{
            $this->view->response("No se pudo actalizar Id=$id", 404);
        }
    }
}
 