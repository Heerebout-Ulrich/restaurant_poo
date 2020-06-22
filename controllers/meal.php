<?php

require "models/meal.php";

class MealController{

private $meal;

    public function __construct(){
    $this->Meal=new Meal();
    }
    
    public function listMeal(){
        $meals=$this->Meal->getMeals();
        $template = "www/home.phtml";
        require "www/layout.phtml";
    }
   
    public function ajouter_produit(){
        
        if(!empty($_POST['name'])){

            $uploads_dir="www/images";   
            if (!empty($_FILES['image']['name'])){
                $tmp_name=$_FILES['image']['tmp_name'];
                $name=$_FILES['image']['name'];
                move_uploaded_file($tmp_name,"$uploads_dir/$name");    
            }     
            
            $nom_produit = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $prix = htmlspecialchars($_POST['prix']);
            $photo = $_FILES['image']['name'];
            
            $infos = $this->Meal->addproduct($nom_produit,$description,$prix, $photo);
            
            if($infos){
                $msgsucess = "Le produit à était ajouté"; 
                $template = "www/admin/homeAdmin.phtml";
                
                }
            else { $msginfo = "Erreur lors de la suppression"; 
            }
            
        }  
        
    $template = "www/admin/create_meal.phtml";
    require "www/admin/layout_admin.phtml";

    }
    
    public function editer_produit(){
    
    $meals = $this->Meal->getMeals();

        if(!empty($_GET['id'])){
        
        $id =  $_GET['id'];
        $meal = $this->Meal->getMealById($id);
        
            if(!empty($_POST['name'])){
                
            $uploads_dir="www/images";   
              
            $nom_produit = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $prix = htmlspecialchars($_POST['prix']);
            $photo = $_FILES['image']['name']; 
            $id = $_GET['id']; 
            
            if (!empty($_FILES['image']['name'])){
                $tmp_name=$_FILES['image']['tmp_name'];
                $name=$_FILES['image']['name'];
                move_uploaded_file($tmp_name,"$uploads_dir/$name");    
            }     
             
            else { $photo = $_POST['image_default']; }
            
            $this->Meal->editproduct($nom_produit,$description,$prix,$photo,$id);
            header ('Location: index.php?action=editer_produit');
            }
        } 
    
    $template = "www/admin/edit_meal.phtml";
    require "www/admin/layout_admin.phtml";
    }
    
    public function supprimer_produit(){
    
        if(isset($_GET['id'])){
        $id_meal = $_GET['id'];       
        $meal = $this->Meal->getMealById($id_meal);    
        $infos = $this->Meal->deleteproduct($id_meal);
        
            if($infos){           
            $image = $meal['photo'];
            $fichier = "www/images/".$image;
            $result = unlink($fichier);    
                    
                
            $msgsucess = "Le produit à était supprimé"; 
             $template = "www/admin/homeAdmin.phtml";
            }
            
            else { $msginfo = "Erreur lors de la suppression";
                   $template = "www/admin/homeAdmin.phtml";
            }
        
        }
        
    require "www/admin/layout_admin.phtml";
    
    } 
    
// Fin de la classe : MealController;  
}