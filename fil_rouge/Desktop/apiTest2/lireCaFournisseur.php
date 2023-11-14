<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$key = $_GET['key'];
$jwt = "eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IlF1ZW50aW4gU2F2YWwiLCJpYXQiOjE1MTYyMzkwMjJ9";

if($key == $jwt){
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=vente_bd2', 'admin', 'Afpa1234');

    $requete = $db->query ("SELECT nom_fourniseur, sum(nb_commander * prix_commander) as chiffre FROM fournisseur join bd on fournisseur.id = bd.fournisseur_id join detail_commande d on bd.id = d.bd_id group by nom_fourniseur");

    $resultat = $requete->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($resultat);
}
else{
    echo "la clé n'est pas la bonne";
}