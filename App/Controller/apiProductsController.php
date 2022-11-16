<?php
require_once "./App/Model/productsModel.php";
require_once "./App/View/apiView.php";

class apiProductsController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new productsModel();
        $this->view = new apiView();
    }


    public function getAll(){
        if(isset($_GET['order'])&&$_GET['order']=="asc"){
            $products = $this->model->getProductsOrderAsc();
        }else if(isset($_GET['order'])&&$_GET['order']=="desc"){
            $products = $this->model->getProductsOrderDesc();
        }else{
            $products = $this->model->getProducts();
        }
        $this->view->response($products, 200);
    }

    public function getOne($params = null){
        $id = $params[":ID"];
        $product = $this->model->getProduct($id);
        if($product){
            $this->view->response($product, 200);
        }else{
            $this->view->response("Error $id no existe", 404);
        }
       
    }
    public function remove($params = null){
        $id = $params[":ID"];
        $product = $this->model->getProduct($id);

        if($product){
            $this->model->deleteProductFromDB($id);
            $this->view->response("Se elimino con exito", 200);
        }else{
            $this->view->response("Error $id no existe", 404);
        }
    }
    public function insert($params = null){
        $body = $this->getBody();
        $id = $this->model->insertProduct($body->id_vendedor_fk, $body->tipo, $body->descripcion, $body->precio);
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
        $product = $this->model->getProduct($id);

        if($product){
            $this->model->updateProductFromDB($body->id_vendedor_fk, $body->tipo, $body->descripcion, $body->precio, $id);
            $this->view->response("Se actualizo con exito id=$id", 200);
        }else{
            $this->view->response("No se pudo actalizar Id=$id", 404);
        }
    }
}
 