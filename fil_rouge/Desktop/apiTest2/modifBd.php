<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$json = file_get_contents('php://input', true);

$data = json_decode($json);

$db = new PDO('mysql:host=localhost;charset=utf8;dbname=vente_bd2', 'admin', 'Afpa1234');
$requete = $db->prepare("update bd set fournisseur_id = :fournisseur, titre = :titre, image_bd = :image, auteur = :auteur, editeur = :editeur, date_edition = :date_edition, resume = :resume, prix = :prix, stock = :stock where id = :id");
$requete->bindValue(":id", $data->id);
$requete->bindValue(":fournisseur", $data->fournisseur_id);
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