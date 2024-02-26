<?php
$clientError = "";
$phoneRegex = "/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/";

if (isset($_POST['clientEditSbmt'])) {
    $originalName = $_POST['originalName'];

    $originalClientQuery = $connection->prepare("SELECT * FROM `clients` WHERE `name` LIKE :originalName");
    $originalClientQuery->execute([':originalName' => $originalName]);
    $originalClient = $originalClientQuery->fetchAll(PDO::FETCH_CLASS, "\\RS\\Client");

    if ($originalClientQuery->rowCount() == 1) {
        $clientName = htmlentities($_POST['clientNameEdit']);
        $clientPhone = htmlentities($_POST['clientPhoneEdit']);
        $clientEmail = htmlentities($_POST['clientEmailEdit']);

        if ($clientName == "") {
            $clientName = $originalClient[0]->name;
        }

        if ($clientPhone == "") {
            $clientPhone = $originalClient[0]->phonenumber;
        }

        if ($clientEmail == "") {
            $clientEmail = $originalClient[0]->email;
        }

        $newClientQuery = $connection->prepare("
UPDATE `clients`   
   SET `name` = :name,
       `phonenumber` = :phonenumber,
       `email` = :email
 WHERE `client_id` = :client_id");
        $newClientQuery->execute([':name' => $clientName, ':phonenumber' => $clientPhone, ':email' => $clientEmail,
            ':client_id' => $originalClient[0]->client_id]);
    }
}