<?php
require_once 'includes/init.php';
require_once 'includes/addClient.php';

//$clients = $connection->query("SELECT * FROM `clients`")->fetchAll(PDO::FETCH_CLASS, "\\RS\\Client");
//print_r($clients);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Klanten</title>
    <meta charset="utf-8"/>
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">-->
    <link rel="stylesheet" href="stylesheets/client.css">
    <!--    <script type="text/javascript" src="js/client/edit.js" defer></script>-->
    <script type="text/javascript" src="js/client/search.js" defer></script>
        <script type="text/javascript" src="js/index/addClientVisibility.js" defer></script>
    <script type="text/javascript" src="js/client/create-content.js" defer></script>
    <script type="text/javascript" src="js/client/prev-next-client.js" defer></script>
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
                        <button><i class="icon prev"></i></button>
                        <img src="stylesheets/icon/arrow-left-solid.svg" id="prevBtnClient" class="headerBtn" data-offset="-1"/>
                        <p class="bookHeaderTitle flex" id="contactHeader">Contactgegevens</p>
                        <img src="stylesheets/icon/arrow-right-solid.svg" id="nextBtnClient" class="headerBtn" data-offset="1"/>
                    </div>
                    <form id="filterForm" class="greyInput">
                        <label for="filterInput">
                            <div><img src="stylesheets/icon/magnifying-glass-solid.svg"
                                      class="headerBtn" alt="Filter"></div>
                        </label>
                        <input type="text" id="filterInput"/>
                    </form>
                </header>
                <div id="left-content"></div>
            </section>
            <section class="right-book">
                <div id="right-content"></div>
            </section>
        </div>
    </div>
    <div class="addBtnDiv" id="addClientBtn">
        <img src="stylesheets/icon/circle-plus-solid.svg" class="addBtn"/>
    </div>
</main>

<div id="overlay">
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



