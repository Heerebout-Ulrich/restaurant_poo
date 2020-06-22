<?php

class Meal{
private $database; 
private $bdd; 

    public function __construct(){
    $this->database=new Database();
    $this->bdd=$this->database->getBdd();
    }
    
    public function getMeals(){
    $query=$this->bdd->prepare("SELECT *, ROUND(prix, 2) as prix2 FROM meal");  
    $query->execute();
    $meals=$query->fetchAll();
    return $meals;
    }
    
    public function getMealById($id){
    $query=$this->bdd->prepare("SELECT *,  ROUND(prix, 2) as prix2 FROM meal WHERE id = ?");  
    $query->execute(array($id));
    $meals=$query->fetch();
    return $meals;
    }
    
    public function addproduct($nom_produit,$description,$prix, $photo){
    $query=$this->bdd->prepare("INSERT INTO meal (name, description, prix, photo) VALUES (?, ?, ?, ?)");  
    $query->execute(array($nom_produit,$description,$prix, $photo));
    return true;
    }
    
    public function editproduct($nom_produit,$description,$prix,$photo,$id){
    $query=$this->bdd->prepare("UPDATE meal SET name = ?, description = ?, prix = ?, photo = ? WHERE meal.id = ?");  
    $query->execute(array($nom_produit,$description,$prix,$photo,$id));
    return true;
    }
    
    public function deleteproduct($id){
    $query=$this->bdd->prepare("DELETE FROM meal WHERE id = ?");
    $query->execute(array($id));
    return true;    
    }


}







?>

