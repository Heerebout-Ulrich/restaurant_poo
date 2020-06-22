<?php

class Order{
    
private $database; 
private $bdd;

    public function __construct(){
    $this->database=new Database();
    $this->bdd=$this->database->getBdd();
    }

public function addorder($id_user,$prix_total,$date){

//Inserer dans la table commande
//INSERT INTO `commandes` (`id`, `id_user`, `date`, `prix_total`) VALUES (NULL, '107', '2020-01-15 00:00:00', '150');
$query=$this->bdd->prepare("INSERT INTO commandes (id_user, date, prix_total) VALUES (?, ?, ?)");
$query->execute(array($id_user,$date,$prix_total));
/*$idcommand = $orders->lastInsertId();*/
$idcommand = $bdd->lastInsertId();
return $idcommand;
}


public function addorderDetails($id_cmd,$commande){
//Inserer le détail d'une commande dans la table ligne_cmd  
//INSERT INTO `lignes_cmd` (`id_cmd`, `id_meal`, `quantite`, `prix_unit`) VALUES ('1', '1', '2', '13.2');

$query=$this->bdd->prepare("INSERT INTO lignes_cmd (id_cmd, id_meal, quantite, prix_unit) VALUES (?, ?, ?, ?)");

foreach($commande as $ligne){
$query->execute(array($id_cmd,$ligne[0]->id,$ligne[1],$ligne[0]->prix));
} 

}

public function affichage_commande(){

$query=$this->bdd->prepare("SELECT commandes.id, nom, prenom, DATE_FORMAT(date, '%d-%m-%Y') as DATE, DATE_FORMAT(date, '%H:%i:%s') AS HEURE, ROUND(prix_total,2) as prix_total FROM commandes INNER JOIN user ON user.id = commandes.id_user ORDER BY id DESC");
$query->execute();
$commandes=$query->fetchAll();
return $commandes;
}

public function delete_commande($id){
 
$addproduct=$bdd->prepare("DELETE FROM commandes WHERE id = ?");
$addproduct->execute(array($id));
return true;    
}

public function details_order($id){

$query=$this->bdd->prepare("SELECT meal.id, name,quantite,ROUND(prix_unit,2) AS prix_unit, ROUND(prix_unit * quantite, 2) as prix_total FROM lignes_cmd INNER JOIN meal ON id_meal = meal.id WHERE id_cmd = ?");
$query->execute(array($id));
$details=$query->fetchAll();
return $details;    
}

public function detailsUserOrder($id){

$query=$this->bdd->prepare("SELECT commandes.id,nom,prenom,email,adresse,code_postal,ville,tel,prix_total FROM user INNER JOIN commandes ON commandes.id_user = user.id WHERE commandes.id = ?");
$query->execute(array($id));
$detailsUser=$query->fetch();
return $detailsUser;    
}

}
?>

