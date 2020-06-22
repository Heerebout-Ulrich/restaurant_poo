<?php

class User{
    private $database; 
    private $bdd;    
    
    public function __construct(){
    $this->database=new Database();
    $this->bdd=$this->database->getBdd();
    }  
    
    public function addUser($nom,$prenom,$mail,$adresse,$codep,$ville,$tel,$password,$naissance){
    $query=$this->bdd->prepare("INSERT INTO user (nom, prenom, email, adresse, code_postal, ville, tel, password, naissance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->execute(array($nom,$prenom,$mail,$adresse,$codep,$ville,$tel,$password,$naissance));
    return true;
    }
    
    public function getUserByEmail($mail){
    $query=$this->bdd->prepare("SELECT * FROM user WHERE email = ?");
    $query->execute(array($mail));
    $user=$query->fetch();
    return $user;  
    }
    
    public function getUserByID($id){
    $query=$this->bdd->prepare("SELECT * FROM user WHERE id = ?");
    $query->execute(array($id));
    $user=$query->fetch();
    return $user;  

    }
    
    public function listusers(){
    $query=$this->bdd->prepare("SELECT * FROM user");
    $query->execute();
    $users=$query->fetchAll();
    return $users;  
    
    }

    public function deleteUser($id){
    $query=$this->bdd->prepare("DELETE FROM user WHERE id = ?");
    $query->execute(array($id));
    return true;    
    }
}

?>