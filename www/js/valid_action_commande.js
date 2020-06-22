'use strict';

var recupProducts;
var quantity;
var commande = [];
var tabplat;
var total;


function affichage(){
$('#panier').html('<tr><th>Quantite</th><th>Produit</th><th>Prix</th><th>Sous Total</th></tr><tr><td></td><td></td><td></td><td id="total"></td></tr>');

commande=localStorage.getItem("panier");


if(commande == null){
    commande = [];
}
else { commande = JSON.parse(commande); }

total = 0;

for(var i=0;i<commande.length;i++){
    total +=commande[i][1]*commande[i][0].prix2;
$('#panier tr:last-child').before('<tr><td>' + commande[i][1] + "</td><td>" + commande[i][0].name + "</td><td>" + commande[i][0].prix2 + "€ </td><td>" + commande[i][0].prix2 * commande[i][1] + " € </td></tr>");
$('#total').html("<strong>TOTAL : "+total.toFixed(2)+" TTC</strong>");
}

}


function affDetails(donnee){
recupProducts = donnee;

$('#product_details img').attr('src','www/images/'+ donnee.photo);
$('#product_details h3').html(donnee.name);
$('#product_details p').html(donnee.description);
$('#product_details span').html(donnee.prix2 + "€");
}

function loadDetails(){

$.getJSON("index.php","action=cmdAjax&id="+$("#menu").val(),affDetails);

}  


function addPanier(){
/*commande = [];*/
tabplat = [recupProducts,$('#nquantity').val()];
commande.push(tabplat);
commande=JSON.stringify(commande);
localStorage.setItem("panier",commande);
affichage();
}

function passerCommande(){


commande=JSON.stringify(commande);
//ValiderCommande()
$.get("index.php","action=cmdAjax&commande="+commande+"&total="+total,ValiderCommande);


}

function ValiderCommande(){
commande=[];
localStorage.removeItem("panier");
$('#panier').html('<span>Votre commande à était envoyé</span>');

}

function Annulerpanier(){
commande=[];
localStorage.removeItem("panier");
$('#panier').html('<span>Votre panier est vide</span>');

}


$(function(){
    $("#menu").on("change",loadDetails);
    $("#ajouter").on("click",addPanier);
    $("#commander").on("click",passerCommande);
    $("#delete-card").on("click",Annulerpanier);

    loadDetails();
/*    affichage();*/
});


console.log("je suis le js");

