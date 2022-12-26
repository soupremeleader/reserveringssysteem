<?php
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