<?php
	session_start();
	
	require_once("database.php");
	
	if(isset($_SESSION['login']))	
	{
		header("Location:index.php");
		exit();
	}

	$login = $_POST['login'];
	$pass = $_POST['password'];
	
	//MYSQL INJECTION PROTECT
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$pass = htmlentities($pass, ENT_QUOTES, "UTF-8");
	
	$db = new Database();
	
	$result = $db -> createDatabase();

	if($result == true)
	{
		echo "Poprawnie stworzono bazę lub tabele. Dziękujemy!";
	}
	else
	{
		echo "Nie można było stworzyć bazy lub tabeli w bazie. Skontaktuj się z administratorem.";
	}

	$result = $db -> loginCheck($login, $pass);
	if($result == true)
	{
		header("Location: index.php");
		unset($_SESSION['error']);	
	}
	else
	{
		header('Location: login.php');
		$_SESSION['error'] = '<span style="color:red"><br />Niestety wprowadzone dane logowania nie pasują. Prosimy spróbować ponownie lub skontaktować się z administratorem.</span>';
	}
	
	$query = "SELECT * from users WHERE login = '$login'";
	$result = $db -> db_query($query); 	// use function to execute query and get row for logged user
	
	$_SESSION['name'] = $result['name'];
	$_SESSION['surname'] = $result['surname'];
	$_SESSION['login'] = $result['login'];
	$_SESSION['password'] = $result['password'];
	$_SESSION['mail'] = $result['mail'];
	$_SESSION['walletUSD'] = $result['walletUSD'];
	$_SESSION['walletEUR'] = $result['walletEUR'];
	$_SESSION['walletCHF'] = $result['walletCHF'];
	$_SESSION['walletRUB'] = $result['walletRUB'];
	$_SESSION['walletCZK'] = $result['walletCZK'];
	$_SESSION['walletGBP'] = $result['walletGBP'];
	$_SESSION['walletPLN'] = $result['walletPLN'];
	
	
	header('Location: index.php');
?>