<?php
session_start();

$login = false;

$error = "";

if (isset($_SESSION['loggedInUser'])) {
    $login = true;
}

if (isset($_POST['submit'])) {
    /**
     * @var \PDO $db
     * @var \PDO $connection
     */
    $givenUN = $_POST['username'];
    $givenPW = $_POST['password'];

    $loginQuery = $connection->prepare("SELECT * FROM `users` WHERE `username`=:username");
    $loginQuery->execute([':username' => $givenUN]);
    $user = $loginQuery->fetchAll(PDO::FETCH_CLASS, "\\RS\\User");

    if (count($user) == 1) {
        if (password_verify($givenPW, $user[0]->password)) {
            $login = true;

            $_SESSION['loggedInUser'] = [
                'id' => $user[0]->id,
                'username' => $user[0]->username,
            ];
            print_r("hello");
            header('Location: index.php');
        } else {
            $error = 'Gebruikersnaam of wachtwoord is incorrect.';
        }
    } else {
        $error = 'Gebruikersnaam of wachtwoord is incorrect.';
    }
}
?>