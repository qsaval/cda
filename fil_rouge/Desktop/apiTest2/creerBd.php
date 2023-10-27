<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$json = file_get_contents('php://input', true);

$data = json_decode($json);

$db = new PDO('mysql:host=localhost;charset=utf8;dbname=vente_db', 'admin', 'Afpa1234');
$requete = $db->prepare("INSERT INTO bd (fournisseur_id, titre, image_bd, auteur, editeur, date_edition, resume, prix, stock) VALUES (:fournisseur_id, :titre, :image, :auteur, :editeur, :date_edition, :resume, :prix, :stock);");
$requete->bindValue(":fournisseur_id", $data->fournisseur_id);
$requete->bindValue(":titre", $data->titre);
$requete->bindValue(":image", $data->image);
$requete->bindValue(":auteur", $data->auteur);
$requete->bindValue(":editeur", $data->editeur);
$requete->bindValue(":date_edition", $data->date_edition);
$requete->bindValue(":resume", $data->resume);
$requete->bindValue(":prix", $data->prix);
$requete->bindValue(":stock", $data->stock);
$requete->execute();

echo('{ "message": "ok" }');