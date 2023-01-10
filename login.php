<?php
require_once "includes/init.php";
require_once 'includes/login.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/login.css">
    <title>Login</title>
</head>
<body>

<main>
    <?php if ($login) {
        header('Location: index.php');
    } else { ?>
        <form method="post" class="greyInput">
            <div>
                <?= $error ?>
                <label for="loginName">Gebruikersnaam</label><br/>
                <input type="text" id="loginName" name="username" placeholder="Voer hier uw gebruikersnaam in"
                       required/><br/>

                <label for="loginPW">Wachtwoord</label><br/>
                <input type="password" id="loginPW" name="password" placeholder="Voer hier uw wachtwoord in" required/>
            </div>
            <div>
                <input type="submit" name="submit" value="Log in"/>
            </div>
        </form>
    <?php } ?>
</main>
</body>
</html>
