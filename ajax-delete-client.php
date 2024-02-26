<?php
require_once 'includes/init.php';

header('Content-type: application/json; charset=utf-8');

$jsonId = file_get_contents('php://input');
$clientName = json_decode($jsonId, true)['name'];


$originalClientQuery = $connection->prepare("SELECT * FROM `clients` WHERE `name` LIKE :originalName");
$originalClientQuery->execute([':originalName' => $clientName]);
$originalClient = $originalClientQuery->fetchAll(PDO::FETCH_CLASS, "\\RS\\Client");

if ($originalClientQuery->rowCount() == 1) {
    $delete = $connection->prepare("DELETE FROM clients WHERE client_id = :client_id");
    $delete->execute([":client_id" => $originalClient[0]->client_id]);
}

$clients = $connection->query("SELECT * FROM clients");
echo json_encode($clients->fetchAll(PDO::FETCH_CLASS, "\\RS\\Client"));
