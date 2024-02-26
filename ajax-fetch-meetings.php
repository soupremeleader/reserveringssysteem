<?php
require_once 'includes/init.php';

header('Content-type: application/json; charset=utf-8');

$jsonDate = file_get_contents('php://input');

$beginDay = json_decode($jsonDate, true)['beginDay'];
$beginMonth = json_decode($jsonDate, true)['beginMonth'];
$beginYear = json_decode($jsonDate, true)['beginYear'];

$endDay = json_decode($jsonDate, true)['endDay'];
$endMonth = json_decode($jsonDate, true)['endMonth'];
$endYear = json_decode($jsonDate, true)['endYear'];

$beginDate = date('Y-m-d H:i:s', mktime(0,0,0, $beginMonth, $beginDay, $beginYear));
$endDate = date('Y-m-d H:i:s', mktime(0,0,0, $endMonth, $endDay, $endYear));

$weekQuery = $connection->prepare(
    "SELECT * FROM clients 
    INNER JOIN meetings ON meetings.client_id = clients.client_id 
    INNER JOIN timeslots ON meetings.timeslot_id = timeslots.timeslot_id 
         WHERE timeslots.begin_time > :beginDate AND timeslots.end_time < :endDate 
         ORDER BY STR_TO_DATE(begin_time,'%h:%i:%s %m/%d/%Y') desc");
$weekQuery->execute([':beginDate' => $beginDate, ':endDate' => $endDate]);
$agenda = $weekQuery->fetchAll(PDO::FETCH_ASSOC);

echo(json_encode($agenda));