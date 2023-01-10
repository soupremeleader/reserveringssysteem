<?php
$meetNameError = "";
$meetDateError = "";

if (isset($_POST['submitMeeting'])) {
    /** @var mysqli $connection
     */
    $meetClient = $_POST['meetClient'];
    $meetDate = $_POST['meetDate'];
    $beginTimeslot = $_POST['beginTimeslot'];
    $endTimeslot = $_POST['endTimeslot'];
    $notes = $_POST['notes'];

    $beginTime = date('Y-m-d H:i:s', strtotime($meetDate . $beginTimeslot));
    $endTime = date('Y-m-d H:i:s', strtotime($meetDate . $endTimeslot));

    $error = false;

    $existingClient = $connection->prepare("SELECT `client_id` FROM `clients` WHERE `name` LIKE :clientName");
    $existingClient->execute([':clientName' => $meetClient]);
    $countClient = $existingClient->fetch();

    if (!isset($countClient['client_id'])) {
        $meetNameError = "Klant bestaat niet! ";
        $error = true;
    }

if ($endTimeslot <= $beginTimeslot) {
    $meetDateError = "Eind tijd moet later zijn dan begin tijd! ";
    $error = true;
}

if (new DateTime($beginTime) < new DateTime()) {
    print_r(new DateTime($beginTime));
    print_r(new DateTime());
    $meetDateError = "Geselecteerd tijdstip is al geweest! ";
    $errror = true;
}

$timeslotsQuery = $connection->prepare("SELECT * FROM `timeslots` WHERE :beginTime <= `end_time` AND :endTime >= `begin_time` ");
$timeslotsQuery->execute([':beginTime' => $beginTime, ':endTime' => $endTime]);
$overlapSlot = $timeslotsQuery->fetchAll(PDO::FETCH_CLASS, "\\RS\\Timeslot");

if (count($overlapSlot) > 0) {
    $meetDateError = "Meeting overlapt! ";
    $error = true;
}

if (!$error) {
    $newTimeslotQuery = $connection->prepare("INSERT INTO `timeslots` (`begin_time`, `end_time`) VALUES (:beginTime, :endTime)");
    $newTimeslotQuery->execute([':beginTime' => $beginTime, ':endTime' => $endTime]);

    $newTimeslotIdQuery = $connection->prepare("SELECT  LAST_INSERT_ID() FROM `timeslots`");
    $newTimeslotIdQuery->execute();
    $newTimeslot = $newTimeslotIdQuery->fetch();

    $newMeetingQuery = $connection->prepare("INSERT INTO `meetings` (`client_id`, `timeslot_id`, `extra_note`) VALUES (:clientId, :timeslotId, :extraNote)");
    $newMeetingQuery->execute([':clientId' => $countClient['client_id'], ':timeslotId' => $newTimeslot['LAST_INSERT_ID()'], ':extraNote' => $notes]);
}

print_r($connection->query("SELECT * FROM `meetings`")->fetchAll(PDO::FETCH_CLASS, "\\RS\\Mee ting"));


}