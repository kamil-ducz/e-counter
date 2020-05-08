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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="btn btn-primary" href="index.php">Internetowy System Wymiany Walut</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarColor03">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">O projekcie <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">O autorze</a>
                                </li>
                            </ul>
                        </div>
            </nav>
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

