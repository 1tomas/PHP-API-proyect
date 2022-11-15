<?php
class userModel{
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=bruma;charset=utf8', 'root', '');
    }


    function insertUser($email,$password){
        $query = $this->db->prepare('INSERT INTO users(email, password) VALUES (?,?)');                                                                                                                   //PREPARO LA SENTENCIA (EL INSERT)
        $query->execute([$email,$password]);
    }


    function getUsers(){
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $user = $query->fetchAll(PDO::FETCH_OBJ); 
        return $user;
    }

    function getUser($id){
        $query = $this->db->prepare( "SELECT * FROM users WHERE id_usuario=?");
        $query->execute([$id]); 
        $seller = $query->fetch(PDO::FETCH_OBJ);   
        return $seller ;
    }

    function deleteUserFromDB($id){
        $query = $this->db->prepare("DELETE FROM users WHERE id_usuario=?");
        $query->execute([$id]);
    }

    function updateUserFromDB($email, $password, $id){
        $query = $this->db->prepare("UPDATE users SET email=?, password=? WHERE id_usuario=?");
        $query->execute([ $email, $password, $id]); 
    }
}