<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db = new PDO('mysql:host=localhost;charset=utf8;dbname=base_test', 'admin', 'Afpa1234');

$requete = $db->query ("SELECT nom_fourniseur, sum(nb_commander * prix_commander) as chiffre FROM fournisseur join bd on fournisseur.id = bd.fournisseur_id join detail on bd.id = detail.bd_id group by nom_fourniseur");

$resultat = $requete->fetchAll(PDO::FETCH_OBJ);

echo json_encode($resultat);