<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db = new PDO('mysql:host=localhost;charset=utf8;dbname=vente_bd2', 'admin', 'Afpa1234');

$id = $_GET['id'];

$idInt = intval($id);

$requete = $db->query ("SELECT b.id, titre, image_bd, auteur, editeur, date_edition, resume, prix, stock, nom_fourniseur, fournisseur_id FROM bd b join fournisseur f on f.id = b.fournisseur_id where b.id = " . $idInt);

$resultat = $requete->fetch(PDO::FETCH_OBJ);

echo json_encode($resultat);