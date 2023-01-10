<?php
require_once 'includes/init.php';
require_once 'includes/addClient.php';

$clients = $connection->query("SELECT * FROM `clients`")->fetchAll(PDO::FETCH_CLASS, "\\RS\\Client");
print_r($clients);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Klanten</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<link rel="stylesheet" href="stylesheets/client.scss">
<script type="text/javascript" src="js/client/edit.js" defer></script>
<script type="text/javascript" src="js/index/addClientVisibility.js" defer></script>
<main>

    <a href=index.php>
        <button><-</button>
    </a>
    <table class="table is-striped mt-4">
        <thead>
        <tr>
            <th>Naam</th>
            <th>Telefoonnummer</th>
            <th>E-mail</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody id="tbodyClient">
        <?php foreach ($clients as $client): ?>
            <tr>
                <td class="is-vcentered"><?= $client->name; ?></td>
                <td class="is-vcentered"><?= $client->email; ?></td>
                <td class="is-vcentered"><?= $client->phonenumber; ?></td>
                <td class="is-vcentered"><a href="details.php?id=<?= $client->client_id; ?>"><img class="icon"
                                                                                                  src="stylesheets/img/circle-info-solid.svg"/></a>
                </td>
                <td class="is-vcentered" ><img data-edit="<?= $client->client_id; ?>"
                                              data-name="<?= $client->name; ?>"
                                              data-email="<?= $client->email; ?>"
                                              data-phone="<?= $client->phonenumber; ?>"
                                               class="icon" src="stylesheets/img/pen-to-square-solid.svg"/>
                </td>
                <td class="is-vcentered"><img  data-remove="<?= $client->client_id; ?>"
                                               data-name="<?= $client->name; ?>"
                            class="icon" src="stylesheets/img/trash-can-regular.svg" /></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <button id="addClientBtn">+</button>
</main>


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

<section id="deleteClientSection">
    <button id="deleteClientBtn">X</button>
    <h1 id="deleteQuestion"></h1>
    <button id="yesBtn">Ja</button><button id="noBtn">Nee</button>
</section>
</body>