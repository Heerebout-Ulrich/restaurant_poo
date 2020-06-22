<?php

session_start();

require "config/database.php";

require "controllers/meal.php";
require "controllers/user.php";
require "controllers/admin.php";
require "controllers/order.php";
require "controllers/booking.php";

$mealcontroller = new MealController();
$usercontroller = new UserController();
$bookingcontroller = new BookingController();
$admincontroller = new AdminController();
$ordercontroller = new OrderController();


if(isset($_GET['action'])){
    switch($_GET['action']){
        case 'create':
      $usercontroller->create_account();
      break;
        case 'connect':
      $usercontroller->connexion();
      break;
         case 'booking':           
      $bookingcontroller->booking();
      break;
        case 'deconnect':
      $usercontroller->deconnect();
      break;
        case 'order':            
      $ordercontroller->order();      
      break;
       case 'cmdAjax':  
      $ordercontroller->cmdAjax();       
      break;
      case 'admin':  
      $admincontroller->admin();          
      break;
       case 'deconnectadmin':
      $admincontroller->deconnectAdmin();
      break;
      case 'ajouter_produit':
      $mealcontroller->ajouter_produit();
      break;
      case 'editer_produit':
      $mealcontroller->editer_produit();      
      break;
      case 'affichage_reservation':
      $bookingcontroller->AffichageResa();      
      break;
      case 'supprimer_produit':
      $mealcontroller->supprimer_produit();      
      break;
      case 'supprimer_reservation':
      $bookingcontroller->supprimer_reservation();      
      break;
       case 'affichage_commandes':
      $ordercontroller->displayOrder();      
      break;
      case 'supprimer_commande':
      $ordercontroller->supprimer_commande();      
      break;
      case 'affichage_utilisateurs':
      $usercontroller->DisplayUsers();      
      break;
      case 'affichage_details_commande':
      $ordercontroller->detail_commande();      
      break;
    }
}
else { $mealcontroller->listMeal(); }