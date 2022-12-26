<?php require_once 'includes/init.php';

$clientID = $_GET['id'];

$current = $connection->prepare("SELECT clients.*, timeslots.begin_time, meetings.extra_note FROM clients INNER JOIN meetings ON meetings.client_id = clients.client_id INNER JOIN timeslots ON meetings.timeslot_id = timeslots.timeslot_id WHERE clients.client_id = :client_id ");
$current->execute([':client_id' => $clientID]);
$current->setFetchMode(PDO::FETCH_CLASS, "\\RS\\Client");
$curClient = $current->fetch();

$notesQuery = $connection->prepare("SELECT timeslots.begin_time, meetings.extra_note FROM meetings INNER JOIN timeslots ON meetings.timeslot_id = timeslots.timeslot_id WHERE meetings.client_id = :client_id ");
$notesQuery->execute([':client_id' => $clientID]);
$curNotes = $notesQuery->fetchAll(PDO::FETCH_DEFAULT);
//print_r($curNotes);
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
<a href=client.php>
    <button><-</button>
</a>
<h1>Contactgegevens</h1>
<p> Naam: <?= $curClient->name?></p>
<p> Telefoonnummer: <?= $curClient->phonenumber?></p>
<p> E-mail: <?= $curClient->email?></p>

<h1>Notities</h1>
<?php foreach ($curNotes as $note): ?>
<h2><?=$note['begin_time']?></h2>
<p><?=$note['extra_note']?></p>
<?php endforeach; ?>

</body>
</html>
