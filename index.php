<?php
require_once 'includes/init.php';
require_once 'includes/addMeeting.php';
require_once 'includes/addClient.php';

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="js/index/addMeetingVisibility.js" defer></script>
    <script type="text/javascript" src="js/index/calendar.js" defer></script>
    <script type="text/javascript" src="js/index/prev-next-btn.js" defer></script>
    <script type="text/javascript" src="js/index/addClientVisibility.js" defer></script>
    <script type="text/javascript" src="js/index/selectWeekNr.js" defer></script>
    <script type="text/javascript" src="js/index/getClientNamesFromDB.js" defer></script>
    <script type="text/javascript" src="js/index/updateTables.js" defer></script>
    <!--    <script type="text/javascript" src="js/main.js" defer></script>-->
    <link rel="stylesheet" href="stylesheets/index.css">
    <title>Agenda</title>
</head>
<header id="logout">
    <a type="button" href="includes/logout.php">Uitloggen</a>
</header>
<body>
<main>
    <div>
        <div id="book">
            <section id="left-agenda">
                <header id="agendaheader">
                    <!--                <button id="todayBtn">Vandaag</button>-->
                    <div>
                        <img src="stylesheets/img/arrow-left-solid.svg" id="prevBtn" data-offset="-1"/>
                        <div>
                            <div>
                                <p id="weeknr"></p>
                                <img src="stylesheets/img/square-caret-down-solid.svg" id="weeknrSelect"/>
                                <img src="stylesheets/img/xmark-solid.svg" id="weeknrExit"/>
                            </div>
                            <form id="weeknrForm">
                                <label for="weeknrInput">Week</label>
                                <input type="number" id="weeknrInput"/>
                                <label for="yearInput"></label>
                                <input type="number" id="yearInput"/>
                                <button id="weeknrSubmit">OK</button>
                            </form>
                        </div>
                        <img src="stylesheets/img/arrow-right-solid.svg" id="nextBtn" data-offset="1"/>
                    </div>
                </header>

                <table id="tableCal-left">
                    <thead id="theadCal-left"></thead>
                    <tbody id="tbodyCal-left"></tbody>
                    <tfoot id="theadCal-left"></tfoot>
                </table>
            </section>
            <section id="right-agenda">
                <table id="tableCal-right">
                    <thead id="theadCal-right"></thead>
                    <tbody id="tbodyCal-right"></tbody>
                    <tfoot id="theadCal-right"></tfoot>
                </table>
                <div id="weekend">
                    <table id="tableCal-sat">
                        <thead id="theadCal-sat"></thead>
                        <tbody id="tbodyCal-sat"></tbody>
                        <tfoot id="theadCal-sat"></tfoot>
                    </table>
                    <table id="tableCal-sun">
                        <thead id="theadCal-sun"></thead>
                        <tbody id="tbodyCal-sun"></tbody>
                        <tfoot id="theadCal-sun"></tfoot>
                    </table>
                </div>

            </section>
        </div>
        <nav>

        </nav>
    </div>
    <div id="meetBtnDiv">
        <img src="stylesheets/img/circle-plus-solid.svg" id="addMeetBtn"/>
    </div>
</main>


</div>

<div id="overlay">
    <section id="addMeetSection">
        <h1>Nieuwe afspraak toevoegen</h1>
        <button id="exitMeetBtn">X</button>
        <form method="post" class="greyInput">
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
        <form method="post" class="greyInput">
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
</div>
</body>

</html>
