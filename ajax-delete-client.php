<?php
require_once 'includes/init.php';

header('Content-type: application/json; charset=utf-8');

$jsonId = file_get_contents('php://input');
$stringId = json_decode($jsonId, true)['client_id'];

$delete = $connection->prepare("DELETE FROM clients WHERE client_id = :client_id");
$delete->execute([":client_id" => $stringId]);

$clients = $connection->query("SELECT * FROM clients");
echo json_encode($clients->fetchAll(PDO::FETCH_CLASS, "\\RS\\Client"));
