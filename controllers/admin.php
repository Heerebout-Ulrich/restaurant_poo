<?php

require "models/admin.php";

class AdminController{
    
private $admin;

    public function __construct(){
    $this->Admin=new Admin();
    }

public function is_admin(){
    
if(!empty($_SESSION['admin'])){
    return true;
}

else { return false; }

}


public function admin(){
    
if(!empty($_POST['mail'])){

$mail = $_POST['mail'];
$password = $_POST['password'];

$infoadmin = $this->Admin->getAdmin($mail);

if($mail = $infoadmin['email'] and password_verify($password, $infoadmin['password']) ){

$_SESSION['admin']['email'] = $infoadmin['email']; 
$_SESSION['admin']['id'] = $infoadmin['id']; 

}

else { $msginfo  = "Problème identifiant ou mot de passe";

}



}

$template = "www/admin/homeAdmin.phtml";
require "www/admin/layout_admin.phtml";

}

public function deconnectAdmin(){
    
if(isset($_SESSION['admin'])){
    $_SESSION=array();
    session_unset();
    session_destroy();
header ('Location: index.php');
}  
}  


}

?>