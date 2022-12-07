<?php
require_once 'includes/init.php';

//echo(json_encode($_POST));
header('Content-type: application/json; charset=utf-8');

//echo(var_dump($_POST));

$jsonName = file_get_contents('php://input');
$stringName = json_decode($jsonName, true)['name'];
$clients = $connection->prepare("SELECT `client_id`, `name` FROM `clients` WHERE `name` LIKE CONCAT ('%', :name, '%')");
$clientsFromDB = $clients->execute([":name" => $stringName]);

echo (json_encode($clients->fetchAll(PDO::FETCH_DEFAULT)));


//}
//echo(json_encode($connection->query("SELECT `client_id`, `name` FROM `clients`")->fetchAll()));
//echo();

//if (isset($_POST['meetClient'])) {
//    print_r($_POST['meetClient']);
//    return ("here: ". connection->query("SELECT name FROM `clients`"));
//    $meetClient = "%".$_POST['meetClient']."%";
//    $reqClientName = $connection->prepare("SELECT * FROM `clients` WHERE name LIKE :meetClient");
//    $reqClient = $reqClientName->execute([':meetClient' => $meetClient]);
//    echo json_encode($reqClient);
//}
