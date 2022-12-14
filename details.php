<?php require_once 'includes/init.php';

$clientID = $_GET['client_id'];
$current = $connection->prepare("SELECT `name` FROM `clients` WHERE `client_id` = :id");
$current->execute([':id' => $clientID]);
$curClient = $current->fetch(PDO::FETCH_CLASS, "\\RS\\Client");

$notesQuery = $connection->prepare("SELECT `timeslot_id`, `extra_note` FROM `meetings` WHERE `client_id` = :id");
$notesQuery->execute([':id' => $clientID]);
$curNotes = $notesQuery->fetchAll(PDO::FETCH_DEFAULT);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informatie</title>
</head>
<body>
<p> Naam: <?= $curClient->name?></p><br>
<p> Telefoonnummer: <?= $curClient->phoneNumber?></p><br>
<p> E-mail: <?= $curClient->email?></p>
</body>
</html>
