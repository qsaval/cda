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

    $annee = $_GET['annee'];

    $anneeInt = intval($annee);

    $requete = $db->query ("SELECT sum(montant_commande) as `chiffreAffaire`, year(date_commande) as annee, month(date_commande) as mois FROM commande where year(date_commande) =" . $anneeInt . " group by month(date_commande)");

    $resultat = $requete->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($resultat);
}
else{
    echo "la clé n'est pas la bonne";
}