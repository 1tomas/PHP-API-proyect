<?php
require_once "./App/Model/userModel.php";
require_once "./App/View/apiView.php";

class apiUsersController{
    private $model;
    private $view;

   function __construct(){
        $this->model = new userModel();
        $this->view = new apiView();
    }


    function getAll(){
        $user = $this->model->getUsers();
        $this->view->response($user, 200);
    }

    function insert($params = null){
        $body = $this->getBody();
        $user = $this->model->insertUser($body->email, $body->password);
        if($user != 0){
            $this->view->response("No se pudo insertar con exito", 500);
        }
        else{
            $this->view->response("Se inserto con exito id=$user", 200 );
        }
        
    }
    private function getBody(){
        $bodyString = file_get_contents("php://input"); 
        return json_decode($bodyString);
    }

    function getOne($params = null){
        $id = $params[":ID"];
        $user = $this->model->getUser($id);
        if($user){
            $this->view->response($user, 200);
        }else{
            $this->view->response("Error $id no existe", 404);
        }
       
    }
    function remove($params = null){
        $id = $params[":ID"];
        $user = $this->model->getUser($id);

        if($user){
            $this->model->deleteUserFromDB($id);
            $this->view->response("Se elimino con exito", 200);
        }else{
            $this->view->response("Error $id no existe", 404);
        }
    }
    function update($params = null){
        $id = $params[":ID"];
        $body = $this->getBody();
        $user = $this->model->getUser($id);

        if($user){
            $this->model->updateUserFromDB($body->email, $body->password, $id);
            $this->view->response("Se actualizo con exito id=$id", 200);
        }else{
            $this->view->response("No se pudo actalizar Id=$id", 404);
        }
    }
}
 