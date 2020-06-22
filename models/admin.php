<?php

class Admin{
private $database; 
private $bdd; 

    public function __construct(){
    $this->database=new Database();
    $this->bdd=$this->database->getBdd();
    }

    public function getAdmin($mail){  
    $query=$this->bdd->prepare("SELECT * FROM admin WHERE email = ?");
    $query->execute(array($mail));
    $admin=$query->fetch();
    return $admin;  
    
    }

}

?>


