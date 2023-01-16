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
<header class="logout">
    <a type="button" href="includes/logout.php">Uitloggen</a>
</header>
<body>
<main>
    <div>
        <div class="book">
            <section class="left-book">
                <header class="bookHeader">
                    <div>
                        <img src="stylesheets/icon/arrow-left-solid.svg" id="prevBtnAgenda" data-offset="-1" class="headerBtn"/>
                        <div>
                            <div>
                                <p id="weeknr" class="bookHeaderTitle flex"></p>
                                <img src="stylesheets/icon/square-caret-down-solid.svg" id="weeknrSelect" class="headerBtn"/>
                                <img src="stylesheets/icon/xmark-solid.svg" id="weeknrExit" class="headerBtn"/>
                            </div>
                            <form id="weeknrForm">
                                <label for="weeknrInput">Week</label>
                                <input type="number" id="weeknrInput"/>
                                <label for="yearInput"></label>
                                <input type="number" id="yearInput"/>
                                <button id="weeknrSubmit">OK</button>
                            </form>
                        </div>
                        <img src="stylesheets/icon/arrow-right-solid.svg" id="nextBtnAgenda" data-offset="1" class="headerBtn"/>
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
            <div></div>
            <div id="todayBtn"></div>
            <div></div>
            <div><a href="client.php"></a></div>
            <div></div>
        </nav>
    </div>
    <div class="addBtnDiv" id="meetBtnDiv">
        <img src="stylesheets/icon/circle-plus-solid.svg" id="addMeetBtn" class="addBtn"/>
    </div>
</main>


</div>

<div id="overlay">
    <section id="addMeetSection">
        <div>
            <img src="stylesheets/icon/circle-xmark-solid.svg" id="exitMeetBtn" class="closeBtn"/>
        </div>
        <form method="post" class="greyInput">
            <h1>Nieuwe afspraak toevoegen</h1>
            <?php if ($meetNameError != "") {
                echo $meetNameError . "<br>";
            }
            ?>
            <div id="clientInput">
                <label for="meetClient">Klant </label>
                <input list="dataClients" id="meetClient" name="meetClient" placeholder="naam klant" required/>
                <datalist id="dataClients"></datalist>
                <div id="addClientBtn">
                    <img src="stylesheets/icon/circle-plus-solid.svg">
                </div>
                <!--                <input type="button" id="addClientBtn" value="+"/><br/>-->
            </div>
            <?php if ($meetDateError != "") {
                echo $meetDateError . "<br>";
            }
            ?>
            <div id="datumInput">
                <label for="meetDate">Datum</label>
                <input id="meetDate" name="meetDate" type="date" required/>
                <label for="beginTimeslot">Van</label>
                <input type="time" name="beginTimeslot" id="beginTimeslot" required/>
                <label for="endTimeslot">tot</label>
                <input type="time" name="endTimeslot" id="endTimeslot" required/>
                <input type="submit" value="OK" name="submitMeeting"/><br/>
            </div>
            <label for="notes"><h2>Extra notities</h2></label>
            <textarea name="notes" rows="4" cols="50" placeholder="Type notities hier..." id="notes"></textarea><br/>
        </form>
    </section>

    <section id="addClientSection">
        <div>
            <img src="stylesheets/icon/circle-xmark-solid.svg" id="exitClientBtn" class="closeBtn"/>
        </div>
        <form method="post" class="greyInput">
            <h1>Nieuwe klant toevoegen</h1>
            <label for="clientName">Naam klant</label>
            <input type="text" id="clientName" name="clientName" placeholder="Naam klant"/>
            <?= $clientError ?><br/>
            <label for="clientPhone">Telefoonnummer</label>
            <input type="tel" id="clientPhone" name="clientPhone" placeholder="06 12 34 56 78"><br/>
            <label for="clientEmail">E-mail</label>
            <input type="email" id="clientEmail" name="clientEmail" placeholder="voorbeeld@email.com"
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/><br/>
            <div>
                <input type="submit" name="clientSbmt" value="Voeg toe"/>
            </div>
        </form>
    </section>
</div>
</body>

</html>
