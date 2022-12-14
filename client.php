<?php require_once 'includes/init.php';

$clients = $connection->query("SELECT * FROM `clients`")->fetchAll(PDO::FETCH_CLASS, "\\RS\\Client");
?>
    <!doctype html>
    <html lang="en">
    <head>
        <title>Klanten</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    </head>
    <link rel="stylesheet" href="stylesheets/client.scss">
<body>

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
        <tbody>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td class="is-vcentered"><?= $client->name; ?></td>
                <td class="is-vcentered"><?= $client->email; ?></td>
                <td class="is-vcentered"><?= $client->phonenumber; ?></td>
                <td class="is-vcentered"><img class="icon" src="img/circle-info-solid.svg" /></td>
                <td class="is-vcentered"><img class="icon" src="img/pen-to-square-solid.svg" /></td>
                <td class="is-vcentered"><img class="icon" src="img/trash-can-regular.svg" /></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>