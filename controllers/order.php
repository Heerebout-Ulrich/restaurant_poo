<?php 

require "models/order.php";

class OrderController{
    
private $order;
private $meal;

    public function __construct(){
    $this->order=new Order();
    $this->Meal=new Meal();
    }

public function order(){

$liste = $this->Meal->getMeals();

$template = "order/order.phtml";
require "www/layout.phtml";

}

function cmdAjax(){

//var_dump("je suis la fonction cmdAjaxs");

    if(isset($_GET['id'])){
    
        $id = $_GET['id'];
        
        $details = $this->Meal->getMealById($id);
        echo json_encode($details);
        
        /*$test = json_encode($details);*/        
        //var_dump($test);
        //var_dump(json_encode($details));
    }
    else if (isset($_GET['commande'])){
        $commande = json_decode($_GET['commande']);
        $prix_total = json_decode($_GET['total']);
        $id_user = $_SESSION['user']['id'];
        $date = date("Y-m-d")." ".date("H:i").":00";
        $last_id = $this->order->addorder($id_user,$prix_total,$date);
        $this->order->addorderDetails($last_id,$commande);
        
    }

}

function displayOrder(){

$commandes = $this->order->affichage_commande();

$template = "www/admin/order.phtml";
require "www/admin/layout_admin.phtml";

}

function supprimer_commande(){

if(!empty($_GET['id'])){
$id = $_GET['id'];    

$infos = $this->order->delete_commande($id);

if($infos){
    $msgsucess = "La commande à était supprimé"; 
    $template = "www/admin/homeAdmin.phtml";
    
    }
else { $msginfo = "Erreur lors de la suppression";
 $template = "www/admin/homeAdmin.phtml"; }


require "www/admin/layout_admin.phtml";
} 
} 

function detail_commande(){

$details_customer = $this->order->detailsUserOrder($_GET['id']);
$details_commandes = $this->order->details_order($_GET['id']);

$template = "www/admin/details_order.phtml";
require "www/admin/layout_admin.phtml";
} 

}

?>