<?php
require_once 'includes/init.php';

header('Content-type: application/json; charset=utf-8');

$jsonName = file_get_contents('php://input');
$stringName = json_decode($jsonName, true)['name'];
$clients = $connection->prepare("SELECT `client_id`, `name` FROM `clients` WHERE `name` LIKE CONCAT ('%', :name, '%')");
$clientsFromDB = $clients->execute([":name" => $stringName]);

echo (json_encode($clients->fetchAll(PDO::FETCH_DEFAULT)));

