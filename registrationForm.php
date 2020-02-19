<?php

	//when user is logged it's impossible to register new user
	require_once("database.php");			// open database.php using require_once instead of include
	if(isset($_SESSION['login']))				// if logged go to index(avoid entering registrationForm manually from browser)
	{
		header("Location:index.php");
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf8" />
		<meta httpequiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
		<title>Registration Form</title>
		<link rel="stylesheet" href="css/registrationFormstyle.css" type="text/css">
		<script language="javascript" type="text/javascript" src="script.js?newversion"></script>
	</head>

	<body>

		<form action="proceedRegistrationData.php" method="post">		<!-- post info from form to php script -->

		Your login :
		<input type="text" name="login" minlength="3"  maxlength="20"  required /> <br />

		Your password: 
		<input type="password" name="password" id="password" minlength="4"  maxlength="20" required /> <br />
		<input type="checkbox" onclick="unhidePassword()">Show password <br />

		Enter your name: 
		<input type="text" name="userName" minlength="3" maxlength="20" /> <br />

		Enter your surname: 
		<input type="text" name="userSurname" minlength="3" maxlength="20" /> <br />

		Enter your e-mail: 
		<input type="email" name="mail" /> <br />
		<p>
		How much money you have in USD:
		<input type="number" name="walletUSD" min="0" max="1000000" value="10000" required /> <br />

		How much money you have in EUR:
		<input type="number" name="walletEUR" min="0" max="1000000" value="10000" required  /> <br />

		How much money you have in CHF:
		<input type="number" name="walletCHF" min="0" max="1000000" value="10000" required  /> <br />

		How much money you have in RUB:
		<input type="number" name="walletRUB" min="0" max="1000000" value="10000" required  /> <br />

		How much money you have in CZK:
		<input type="number" name="walletCZK" min="0" max="1000000" value="10000" required  /> <br />

		How much money you have in GBP:
		<input type="number" name="walletGBP" min="0" max="1000000" value="10000" required  /> <br />

		How much money you have in PLN:
		<input type="number" name="walletPLN" min="0" max="1000000" value="10000" required  /> <br />

		<a href="index.php">Back</a>
		<input type="submit" style="height: 30px; width: 80px" value="Register" />




		</form>

	</body>

</html>