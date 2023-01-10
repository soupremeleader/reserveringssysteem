<?php

use RS\Databases\Database;

require_once 'settings.php';
require_once 'classes/Agenda.php';
require_once 'classes/Client.php';
require_once 'classes/Meeting.php';
require_once 'classes/Timeslot.php';
require_once 'classes/User.php';
require_once 'classes/Databases/Database.php';

try {
    $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection = $db->getConnection();

    $meetingsFromDB = $connection->query('SELECT * FROM meetings')->fetchAll(PDO::FETCH_CLASS, '\\RS\\Meeting');
    $timeslotsFromDB = $connection->query('SELECT * FROM timeslots')->fetchAll(PDO::FETCH_CLASS, '\\RS\\Timeslot');
    $agenda = new RS\Agenda($meetingsFromDB, $timeslotsFromDB);

} catch (Exception $e) {
    //Set error variable for template
    $error = 'Oops, try to fix your error please: ' .
        $e->getMessage() . ' on line ' . $e->getLine() . ' of ' .
        $e->getFile();
}