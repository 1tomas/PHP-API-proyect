<?php
class productsModel{

    private $db;

    function __construct(){
        $this->db =  new PDO('mysql:host=localhost;'.'dbname=bruma; charset=utf8' , 'root', '');
    }
    function getProducts(){
        $query = $this->db->prepare( 'SELECT a.*, b.* FROM producto a INNER JOIN vendedor b ON a.id_vendedor_fk = b.id_vendedor;');
                        //new PDO('mysql:host=localhost;'.'dbname=bruma; charset=utf8' , 'root', '');
        $query->execute();
        
        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    function insertProduct($sellerFk, $type ,$description, $price){

        $query = $this->db->prepare( 'INSERT INTO producto(id_vendedor_fk, tipo, descripcion, precio) VALUES (?,?,?,?)');

        $query->execute([$sellerFk, $type ,$description, $price]);

        $this->db->lastInsertId();

    }

    function deleteProductFromDB($id){
        $query = $this->db->prepare("DELETE FROM producto WHERE id_producto=?");
        $query->execute([$id]);
       
    }

    function getProduct($id){
        $query = $this->db->prepare( "SELECT * FROM PRODUCTO WHERE id_producto=?");
        $query->execute([$id]); 
        $product = $query->fetch(PDO::FETCH_OBJ);   
        return $product;
    }

    function updateProductFromDB($sellerFk, $type ,$description, $price, $id){
        $query = $this->db->prepare("UPDATE producto SET id_vendedor_fk=?, tipo=?, descripcion=?, precio=? WHERE id_producto=?");
        $query->execute([$sellerFk, $type ,$description, $price, $id]); 
    }

    public function getProductsOrderAsc(){
        $query = $this->db->prepare("SELECT a.*,b.* FROM producto a INNER JOIN vendedor b ON a.id_vendedor_fk = b.id_vendedor ORDER BY a.tipo ASC;");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
    public function getProductsOrderDesc(){
        $query = $this->db->prepare("SELECT a.*,b.* FROM producto a INNER JOIN vendedor b ON a.id_vendedor_fk = b.id_vendedor ORDER BY a.tipo DESC;");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    

}