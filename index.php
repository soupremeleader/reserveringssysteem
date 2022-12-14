<?php
require_once 'includes/init.php';
$clientError = "";

if (isset($_POST['clientSbmt'])) {
    $clientName = $_POST['clientName'];
    $clientPhone = $_POST['clientPhone'];
    $clientEmail = $_POST['clientEmail'];

    $existingClient = $connection->prepare("SELECT `name` FROM `clients` WHERE `name` LIKE :clientName");
    $existingClient->execute([':clientName' => $clientName]);
    $countClient = $existingClient->fetch();
    print_r($countClient);

    if ($clientName == "") {
        $clientError = "Vul naam van klant in!";

    } else if ($clientPhone == "" || $clientEmail == "") {
        $clientError = "Geen contact aangeleverd!";

    } else if (is_array($countClient)) {
        $clientError = "Klant bestaat al!";

    } else {
        $newClient = $connection->prepare("INSERT INTO `clients` (`name`, `phonenumber`, `email`) VALUES (:clientName, :clientPhone, :clientEmail)");
        $newClient->execute([':clientName' => $clientName, ':clientPhone' => $clientPhone, ':clientEmail' => $clientEmail]);
        print_r($connection->query("SELECT * FROM `clients`")->fetchAll(PDO::FETCH_CLASS, "\\RS\\Client"));
    }
}


$meetNameError = "";
$meetDateError = "";

if (isset($_POST['submitMeeting'])) {
    $meetClient = $_POST['meetClient'];
    $meetDate = $_POST['meetDate'];
    $beginTimeslot = $_POST['beginTimeslot'];
    $endTimeslot = $_POST['endTimeslot'];
    $notes = $_POST['notes'];

    $beginTime = date('Y-m-d H:i:s', strtotime($meetDate . $beginTimeslot));
    $endTime = date('Y-m-d H:i:s',strtotime($meetDate . $endTimeslot));

    $error = false;

    if ($meetClient == "") {

        $meetNameError = "Vul naam van klant in! ";
        $error = true;
    }

    if ($meetDate == "" || $beginTimeslot == "" || $endTimeslot == "") {
        $meetDateError = "Een afspraak moet een datum, beginpunt en eindpunt hebben! ";
        $error = true;
    }

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

    if ($beginTime < new DateTime()) {
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

    print_r($connection->query("SELECT * FROM `meetings`")->fetchAll(PDO::FETCH_CLASS, "\\RS\\Meeting"));


}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/index.scss">
    <script type="text/javascript" src="js/addMeetingVisibility.js" defer></script>
    <script type="text/javascript" src="js/calendar.js" defer></script>
    <script type="text/javascript" src="js/prev-next-btn.js" defer></script>
    <script type="text/javascript" src="js/addClientVisibility.js" defer></script>
    <script type="text/javascript" src="js/selectWeekNr.js" defer></script>
    <script type="text/javascript" src="js/getClientNamesFromDB.js" defer></script>
    <!--    <script type="text/javascript" src="js/main.js" defer></script>-->
    <title>Agenda</title>
</head>
<body>
<header>
    <button id="todayBtn">Vandaag</button>
    <div>
        <button id="prevBtn" data-offset="-1"> <-</button>
        <div>
            <div>
                <p id="weeknr"></p>
                <button id="weeknrSelect">V</button>
                <button id="weeknrExit">X</button>
            </div>
            <form id="weeknrForm">
                <label for="weeknrInput">Week</label>
                <input type="number" id="weeknrInput"/>
                <label for="yearInput"></label>
                <input type="number" id="yearInput"/>
                <button id="weeknrSubmit">OK</button>
            </form>
        </div>
        <button id="nextBtn" data-offset="1"> -></button>
    </div>
</header>
<main>
    <table id="tableCal">
        <thead id="theadCal"></thead>
        <tbody id="tbodyCal"></tbody>
        <tfoot id="theadCal"></tfoot>
    </table>
    <button id="addMeetBtn">+</button>
    <a href=client.php>
        <button>klanten</button>
    </a>
</main>

<section id="addMeetSection">
    <h1>Nieuwe afspraak toevoegen</h1>
    <button id="exitMeetBtn">X</button>
    <form method="post">
        <?= $meetNameError ?><br/>
        <label for="meetClient">Klant </label>
        <input list="dataClients" id="meetClient" name="meetClient" placeholder="naam klant"/>
        <datalist id="dataClients"></datalist>
        <input type="button" id="addClientBtn" value="+"/><br/>
        <?= $meetDateError ?><br/>
        <label for="meetDate">Datum</label>
        <input id="meetDate" name="meetDate" type="date"/>
        <label for="beginTimeslot">Van</label>
        <input type="time" name="beginTimeslot" id="beginTimeslot"/>
        <label for="endTimeslot">tot</label>
        <input type="time" name="endTimeslot" id="endTimeslot"/>
        <input type="submit" value="OK" name="submitMeeting"/><br/>
        <label for="notes">Extra notities</label><br/>
        <textarea name="notes" rows="4" cols="50" placeholder="Type notities hier..." id="notes"></textarea><br/>
    </form>
</section>
<section id="addClientSection">
    <h1>Nieuwe klant toevoegen</h1>
    <button id="exitClientBtn">X</button>
    <form method="post">
        <label for="clientName">Naam klant:</label>
        <input type="text" id="clientName" name="clientName" placeholder="Naam klant"/>
        <?= $clientError ?><br/>
        <label for="clientPhone">Telefoonnummer: </label>
        <input type="tel" id="clientPhone" name="clientPhone" pattern="[0-9]{10}"/><br/>
        <label for="clientEmail">E-mail: </label>
        <input type="email" id="clientEmail" name="clientEmail"/><br/>
        <input type="submit" name="clientSbmt" value="Voeg toe"/>
    </form>
</section>
</body>
</html>
