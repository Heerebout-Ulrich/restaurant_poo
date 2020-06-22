<?php

class Database {

private $bdd;

// Constructeur
public function __construct(){
$this->bdd=new PDO('mysql:host=localhost;dbname=*;charset=utf8','*','*');
}

// Getteur
public function getBdd(){
    return $this->bdd;

}
}

?>