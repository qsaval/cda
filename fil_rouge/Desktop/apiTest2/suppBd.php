<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$key = $_GET['key'];
$jwt = "eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IlF1ZW50aW4gU2F2YWwiLCJpYXQiOjE1MTYyMzkwMjJ9";

if($key == $jwt){
    $json = file_get_contents('php://input', true);

    $data = json_decode($json);

    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=vente_bd2', 'admin', 'Afpa1234');
    $requete = $db->prepare("delete from bd where id = :id");
    $requete->bindValue(':id', $data->id);
    $requete->execute();

    echo('{ "message": "ok" }');
}
else{
    echo ('{ "message": "la clé n\'est pas la bonne"}');
}