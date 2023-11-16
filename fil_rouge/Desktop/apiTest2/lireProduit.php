<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$key = $_GET['key'];
$jwt = "eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IlF1ZW50aW4gU2F2YWwiLCJpYXQiOjE1MTYyMzkwMjJ9";

if($key == $jwt){
    $id = $_GET['id'];

    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=vente_bd2', 'admin', 'Afpa1234');

    $requete = $db->query ("SELECT d.id, b.titre, d.nb_commander, d.prix_commander, d.nb_commander * d.prix_commander as prix_total  from detail_commande d join bd b on b.id = d.bd_id where commande_id = " . $id);

    $resultat = $requete->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($resultat);
}
else{
    echo ('{ "message": "la clé n\'est pas la bonne"}');
}