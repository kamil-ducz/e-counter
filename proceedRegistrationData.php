<?php
	session_start();
	
	//block registration when user logged
	require_once("database.php");
	if(isset($_SESSION['login']))
	{
		header("Location:index.php");
		exit();
	}
	
	require_once('database.php');
	
	$login = $_POST['login'];
	$pass = $_POST['password'];
	$pass2 = $_POST['password2'];
	$userName = $_POST['userName'];
	$userSurname = $_POST['userSurname'];
	$WalletUSD = $_POST['walletUSD'];
	$WalletEUR = $_POST['walletEUR'];
	$WalletCHF = $_POST['walletCHF'];
	$WalletRUB = $_POST['walletRUB'];
	$WalletCZK = $_POST['walletCZK'];
	$WalletGBP = $_POST['walletGBP'];
	$WalletPLN = $_POST['walletPLN'];
	
	$db = new Database();
	$result = $db -> createDatabase();
	
	if (false == $result)
	{
		$_SESSION['error'] = "Can not create database!";
		header('location:index.php');
		exit;
	}
	
	$result = $db -> checkUser($login);
	
	if (false == $result)
	{
		$_SESSION['error'] =  '<span style="color:red">Użytkownik z takim adresem e-mail już istnieje. Wprowadź inny adres e-mail.</span>';
		//header('location:index.php');
		//exit;			//exit to avoid redundant code 
	}
	
	$result = $db -> registerUser($userName, $userSurname, $login, $pass, $WalletUSD, $WalletEUR, $WalletCHF, $WalletRUB, $WalletCZK, $WalletGBP, $WalletPLN);
	if(false == $result)
	{
		$_SESSION['error'] =  "Unable to register.";
	}
	else
	{	
		$_SESSION['error'] = '<span style="color:yellow">Użytkownik '.$login.' zarejestrowany. Dziękujemy!</span>';
	}
	header('location:index.php');
?>