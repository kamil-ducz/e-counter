<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta Content-Type = "application/json" charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Internetowy System Wymiany Walut</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
    <div class="navbar">
        <div align="left" text-decoration="none"><a href="index.php"><span class="">Internetowy System Wymiany Walut</span></a></div>
        <br />
    </div>
    <form action="proceedLoginData.php" method="post">
        <div class="form-group">
            <label for="inputEmail">E-mail</label>
            <input type="text" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Wprowadź e-mail" name="login" />
            <small id="emailHelp" class="form-text text-muted">Nigdy nie udostępnimy Twojego adresu e-mail.</small>
        </div>
        <div class="form-group">
            <label for="inputPassword">Hasło</label>
            <input type="password" class="form-control" id="inputPassword" aria-describedby="passwordHelp" placeholder="Wprowadź hasło" name="password" />
            <small id="passwordHelp" class="form-text text-muted">Twoje hasło jest zaszyfrowane i nigdy go nikomu nie udostępnimy.</small>
        </div>
        <button type="submit" class="btn btn-primary" value="Login">Zaloguj</button>
    </form>
    Nie masz konta?<a href="registrationForm.php"> Zarejestruj się</a>

    <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
    ?>

</div>
</body>

