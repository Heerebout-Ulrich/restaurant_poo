<?php

require "models/user.php";

class UserController{
    
    private $customer;

    public function __construct(){
    $this->Customer=new User();
    }

public function create_account(){

$template = "user/create_account.phtml";

if (!empty($_POST["nom"])){
    
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['mail']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $codep = htmlspecialchars($_POST['codep']);
    $ville = htmlspecialchars($_POST['ville']);
    $tel = htmlspecialchars($_POST['telephone']);
    $pass = htmlspecialchars($_POST['password']);
    
    $password = password_hash($pass, PASSWORD_DEFAULT);
    $naissance = $_POST['annee']."-".$_POST['mois']."-".str_pad($_POST['jour'], 2, 0, STR_PAD_LEFT);
        
        if(empty($this->Customer->getUserByEmail($mail))){
        
        $infos = $this->Customer->addUser($nom,$prenom,$mail,$adresse,$codep,$ville,$tel,$password,$naissance);
       
            if(!empty($this->Customer->getUserByEmail($mail)))
            { header('Location: index.php?action=connect'); }
            else { header('Location: index.php'); }
    
        }
        
        else { $msginfo  = "L'adresse mail existe deja"; }

}

require "www/layout.phtml";
}

public function connexion(){
// function qui permet de faire la vérification du pseudo et de mot de passe du client qui essaie de s'authentifier.

    if(!empty($_POST)){
    
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    
    $infouser = $this->Customer->getUserByEmail($mail);
    
    if($mail = $infouser['email'] and password_verify($password, $infouser['password']) ){
    $_SESSION['user']['email'] = $infouser['email']; 
    $_SESSION['user']['nom'] = $infouser['nom'];
    $_SESSION['user']['prenom'] = $infouser['prenom']; 
    $_SESSION['user']['id'] = $infouser['id']; 
    
    header('Location: index.php');
    }
    else { 
        $msginfo  = "Problème identifiant ou mot de passe";
        $template = "user/connect.phtml";
        }
    }

$template = "user/connect.phtml";
require "www/layout.phtml";
}

public function is_connect(){
    
if(!empty($_SESSION['user'])){
    return true;
}

else { return false; }

}

public function deconnect(){
    
if(isset($_SESSION['user'])){
    $_SESSION=array();
    session_unset();
    session_destroy();
header ('Location: index.php');
}  

}

public function DisplayUsers(){

$users = $this->Customer->listusers();

    if(!empty($_GET['delete_utilisateur'])){
    $id = $_GET['delete_utilisateur'];    
    $infos = $this->Customer->deleteUser($id);
    
    if($infos){
        $msgsucess = "L'utilisateur à était supprimé"; 
        $template = "www/admin/users.phtml";
        
        }
    else { $msginfo = "Erreur lors de la suppression"; }
    
    }


$template = "www/admin/users.phtml";
require "www/admin/layout_admin.phtml";

}

}
?>
