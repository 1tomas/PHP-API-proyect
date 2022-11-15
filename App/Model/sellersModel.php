<?php
class sellersModel{

    private $db;

    function __construct(){
        $this->db =  new PDO('mysql:host=localhost;'.'dbname=bruma; charset=utf8' , 'root', '');
    }
    
    function getSellers(){
        $query = $this->db->prepare( 'SELECT * FROM vendedor');

        $query->execute();
        
        $sellers = $query->fetchAll(PDO::FETCH_OBJ);

        return $sellers;
    }

    function insertSeller($seller, $name, $file){

        $query = $this->db->prepare( 'INSERT INTO vendedor(id_vendedor, nombre, legajo) VALUES (?,?,?)');

        $query->execute([$seller, $name, $file]);

    }

    function deleteSellerFromDB($id){
        $query = $this->db->prepare("DELETE FROM vendedor WHERE id_vendedor=?");
        $query->execute([$id]);
    }

    function getSeller($id){
        $query = $this->db->prepare( "SELECT * FROM vendedor WHERE id_vendedor=?");
        $query->execute([$id]); 
        $seller = $query->fetch(PDO::FETCH_OBJ);   
        return $seller ;
    }

    function updateSellerFromDB($name, $file, $id){
        $query = $this->db->prepare("UPDATE vendedor SET nombre=?, legajo=? WHERE id_vendedor=?");
        $query->execute([ $name, $file, $id]); 
    }
}
