<?php

require "models/booking.php";

class BookingController{
    
private $booking;    

    public function __construct(){
    $this->Booking=new Booking();
    }

    public function booking(){
    
    if(!empty($_POST)){ 
    
    $id_user = $_SESSION['user']['id'];
    $datefr = $_POST['date'];
    $heure = $_POST['heure'];
    $format_us = implode('/',array_reverse  (explode('/',$datefr)));
    $date = $format_us." ".$heure.":00";
    $nb_couvert = $_POST['nb_couvert'];
    
    $info = $this->Booking->insertResa($id_user,$date,$nb_couvert);
    
        if($info){
          $msgsucess = "Réservation envoyé";  
        }
    
    }
    
    $template = "booking/booking.phtml";
    require "www/layout.phtml";
    
    }
    
    public function AffichageResa(){
    
    $reservations = $this->Booking->displayResa();
    
    $template = "www/admin/reservations.phtml";
    require "www/admin/layout_admin.phtml";
    
    }
    
    public function supprimer_reservation(){
    
    if(!empty($_GET['id'])){
    $id = $_GET['id'];    
    $infos = $this->Booking->deleteresa($id);
    
    if($infos){
        $msgsucess = "La réservation à était supprimé"; 
    /*    header('Location: index.php?action=affichage_reservation');*/
        $template = "www/admin/homeAdmin.phtml";
        }
    else { $msginfo = "Erreur lors de la suppression"; 
    /*header('Location: index.php?action=affichage_reservation');*/
     $template = "www/admin/homeAdmin.phtml";
    } } 
    /*$template = "www/admin/reservations.phtml";*/
    require "www/admin/layout_admin.phtml";
    }

}


?>