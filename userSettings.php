<?php
session_start();
unset($_SESSION['error']);

?>
<!DOCTYPE HTML> 
<html lang="pl">
<head>
	<meta charset="utf8" />
	<meta httpequiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title>Internetowy System Wymiany Walut</title>
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/fontello.css" type="text/css">
	<script language="javascript" type="text/javascript" src="script.js?newversion"></script>
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

         <form action="updateUserData.php" method="post"> 
            <div class="form-group">
               <label for="inputEmail">E-mail</label>
               <input type="text" class="form-control" id="inputEmail" aria-describedby="emailHelp" value="<?php echo $_SESSION['login']?>" disabled="disabled"/>
               <small id="emailHelp" class="form-text text-muted">Nigdy nie udostępnimy Twojego adresu e-mail.</small>
            </div>
            <div class="form-group">
               <label for="inputPassword">Nowe hasło</label>
               <input type="password" class="form-control" id="inputPassword" aria-describedby="passwordHelp" minlength="4"  maxlength="20" placeholder="Wprowadź nowe hasło" />
               <small id="passwordHelp" class="form-text text-muted">Twoje hasło jest zaszyfrowane i nigdy go nikomu nie udostępnimy.</small>
            </div>
            <div class="form-group">
               <label for="inputPassword2">Powtórz nowe hasło</label>
               <input type="password" class="form-control" id="inputPassword2" placeholder="Powtórz hasło" name="password2" id="inputPassword2" oninput="checkPassword(this)"  minlength="4"  maxlength="20" />
            </div>
            <div class="form-group">
            <label for="inputFirstName">Imię</label>
            <input type="text" name="userName" minlength="3" maxlength="20" class="form-control" id="inputFirstName" value="<?php echo $_SESSION['name']?>" placeholder="Wprowadź swoje imię" />
            </div>
            <div class="form-group">
            <label for="inputFirstName">Nazwisko</label>
            <input type="text" name="userSurname" minlength="3" maxlength="20" class="form-control" id="inputSurname" value="<?php echo $_SESSION['surname']?>" placeholder="Wprowadź swoje nazwisko" />
            </div>
            <a href="index.php" class="icon-power">Powrót</a> 
            <button type="submit" class="btn btn-primary">Zapisz zmiany</button> 
         </form>
         <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
    ?>
   </div>
</body>
</html>