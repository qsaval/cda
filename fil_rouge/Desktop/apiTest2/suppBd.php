<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$json = file_get_contents('php://input', true);

$data = json_decode($json);

$db = new PDO('mysql:host=localhost;charset=utf8;dbname=base_test', 'admin', 'Afpa1234');
$requete = $db->prepare("delete from bd where id = :id");
$requete->bindValue(':id', $data->id);
$requete->execute();

echo('{ "message": "ok" }');

