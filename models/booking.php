<?php
class Booking{
    
private $database; 
private $bdd; 

    public function __construct(){
    $this->database=new Database();
    $this->bdd=$this->database->getBdd();
    }
    
        
    public function insertResa($id_user,$date,$nb_couvert){
    $query=$this->bdd->prepare("INSERT INTO reservation (id_user, date, nb_couverts) VALUES (?, ?, ?)");
    $query->execute(array($id_user,$date,$nb_couvert));
    return true;
    
    }
    
    public function displayResa(){
    
    $query=$this->bdd->prepare("SELECT reservation.id, DATE_FORMAT(date, '%d-%m-%Y') as DATE, DATE_FORMAT(date, '%H:%i:%s') AS HEURE, nb_couverts, nom, prenom FROM reservation INNER JOIN user ON user.id = reservation.id_user ORDER BY DATE DESC");
    $query->execute();
    $reservations=$query->fetchAll();
    return $reservations;
    }
    
    public function deleteresa($id){
    $query=$this->bdd->prepare("DELETE FROM reservation WHERE id = ?");
    $query->execute(array($id));
    return $query;
    }

}

?>


