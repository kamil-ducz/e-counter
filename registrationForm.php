
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf8" />
	<meta httpequiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
	<title>Registration Form</title>
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/fontello.css" type="text/css">
	<script language="javascript" type="text/javascript" src="script.js?newversion"></script>
</head>
<body>
		<div class="container">
		<div class="navbar">
				<h3><a href="index.php"><span class="">Internetowy System Wymiany Walut</span></a></h>
			</div>

		<form action="proceedRegistrationData.php" method="post" oninput='up2.setCustomValidity(password.value != password2.value ? "Passwords do not match." : "")'>
			<h4>Twoje dane</h>
			<div class="form-group">
				<label for="inputEmail">E-mail</label>
				<input type="text" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Wprowadź e-mail" name="login" minlength="3"  maxlength="20"  required />
				<small id="emailHelp" class="form-text text-muted">Nigdy nie udostępnimy Twojego adresu e-mail.</small>
			</div>
			<div class="form-group">
				<label for="inputPassword">Hasło</label>
				<input type="password" class="form-control" id="inputPassword" aria-describedby="passwordHelp" placeholder="Wprowadź hasło" name="password" id="inputPassword" minlength="4"  maxlength="20" required />
				<small id="passwordHelp" class="form-text text-muted">Twoje hasło jest zaszyfrowane i nigdy go nikomu nie udostępnimy.</small>
			</div>
			<div class="form-group">
				<label for="inputPassword2">Powtórz hasło</label>
				<input type="password" class="form-control" id="inputPassword" aria-describedby="passwordHelp" placeholder="Powtórz hasło" name="password2" id="inputPassword2" minlength="4"  maxlength="20" required />
			</div>
			<div class="form-group">
			<label for="inputFirstName">Imię</label>
			<input type="text" name="userName" minlength="3" maxlength="20" class="form-control" id="inputFirstName" placeholder="Wprowadź swoje imię" />
			</div>
			<div class="form-group">
			<label for="inputFirstName">Nazwisko</label>
			<input type="text" name="userSurname" minlength="3" maxlength="20" class="form-control" id="inputSurname" placeholder="Wprowadź swoje nazwisko" />
			</div>
			<h4>Twój portfel</h4>
			<div class="form-group">
			<label>Dolary USD</label>
			<input type="number" name="walletUSD" min="0" max="1000000" value="100" class="form-control" required />
			</div>
			<div class="form-group">
			<label>Euro EUR</label>
			<input type="number" name="walletEUR" min="0" max="1000000" value="75" class="form-control" required  />
			</div>
			<div class="form-group">
			<label>Franki Szwajcarskie CHF</label>
			<input type="number" name="walletCHF" min="0" max="1000000" value="75" class="form-control" required  />
			</div>
			<div class="form-group">
			<label>Rosyjskie Ruble RUB</label>
			<input type="number" name="walletRUB" min="0" step="100" max="1000000" value="600" class="form-control" required  />
			</div>
			<div class="form-group">
			<label>Korony Czeskie CZK</label>
			<input type="number" name="walletCZK" min="0" step="100" max="1000000" value="800" class="form-control" required  />
			<div class="form-group">
			<label>Funty Brytyjskie GBP</label>
			<input type="number" name="walletGBP" min="0" max="1000000" value="50" class="form-control" required  />
			</div>
			<div class="form-group">
			<label>Polskie Złotówki</label>
			<input type="number" name="walletPLN" min="0" max="1000000" value="300" class="form-control" required  />
			</div>
			<a href="index.php" class="icon-power">Powrót</a>
			<button type="submit" class="btn btn-primary">Zarejestruj</button>
		</form>
	</div>

</body>
</html>