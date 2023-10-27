<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db = new PDO('mysql:host=localhost;charset=utf8;dbname=base_test', 'admin', 'Afpa1234');

$annee = $_GET['annee'];

$anneeInt = intval($annee);

$requete = $db->query ("SELECT sum(montant_commande) as `chiffreAffaire`, year(date_commande) as annee, month(date_commande) as mois FROM commande where year(date_commande) =" . $anneeInt . " group by month(date_commande)");

$resultat = $requete->fetch(PDO::FETCH_OBJ);

echo json_encode($resultat);