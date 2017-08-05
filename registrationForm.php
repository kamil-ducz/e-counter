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
</head>

<body>

<form action="proceedRegistrationData.php" method="post">		<!-- post info from form to php script -->

Your login :
<input type="text" name="login" /> <br />

Your password: 
<input type="password" name="password" /> <br />

Enter your name: 
<input type="text" name="userName" /> <br />

Enter your surname: 
<input type="text" name="userSurname" /> <br />

Enter your e-mail: 
<input type="text" name="mail" /> <br />
<p>
How much money you have in USD:
<input type="text" name="walletUSD" /> <br />

How much money you have in EUR:
<input type="text" name="walletEUR" /> <br />

How much money you have in CHF:
<input type="text" name="walletCHF" /> <br />

How much money you have in RUB:
<input type="text" name="walletRUB" /> <br />

How much money you have in CZK:
<input type="text" name="walletCZK" /> <br />

How much money you have in GBP:
<input type="text" name="walletGBP" /> <br />

How much money you have in PLN:
<input type="text" name="walletPLN" /> <br />

<a href="index.php">Back</a>
<input type="submit" style="height: 30px; width: 80px" value="Register" />



</form>

</body>

</html>