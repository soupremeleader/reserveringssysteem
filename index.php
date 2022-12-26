<?php
require_once 'includes/init.php';
require_once 'includes/addMeeting.php';
require_once 'includes/addClient.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/index.scss">
    <script type="text/javascript" src="js/index/addMeetingVisibility.js" defer></script>
    <script type="text/javascript" src="js/index/calendar.js" defer></script>
    <script type="text/javascript" src="js/index/prev-next-btn.js" defer></script>
    <script type="text/javascript" src="js/index/addClientVisibility.js" defer></script>
    <script type="text/javascript" src="js/index/selectWeekNr.js" defer></script>
    <script type="text/javascript" src="js/index/getClientNamesFromDB.js" defer></script>
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
        <input list="dataClients" id="meetClient" name="meetClient" placeholder="naam klant" required/>
        <datalist id="dataClients"></datalist>
        <input type="button" id="addClientBtn" value="+"/><br/>
        <?= $meetDateError ?><br/>
        <label for="meetDate">Datum</label>
        <input id="meetDate" name="meetDate" type="date" required/>
        <label for="beginTimeslot">Van</label>
        <input type="time" name="beginTimeslot" id="beginTimeslot" required/>
        <label for="endTimeslot">tot</label>
        <input type="time" name="endTimeslot" id="endTimeslot" required/>
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
