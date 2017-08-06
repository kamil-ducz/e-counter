<?php
	session_start();
	
	//when user is logged it's impossible to register new user
	require_once("database.php");
	if(isset($_SESSION['login']))
	{
		header("Location:index.php");
		exit();
	}
	
	require_once('database.php');
	
	$login = $_POST['login'];		//set variables from form
	$pass = $_POST['password'];
	$userName = $_POST['userName'];
	$userSurname = $_POST['userSurname'];
	$userMail = $_POST['mail'];
	$WalletUSD = $_POST['walletUSD'];
	$WalletEUR = $_POST['walletEUR'];
	$WalletCHF = $_POST['walletCHF'];
	$WalletRUB = $_POST['walletRUB'];
	$WalletCZK = $_POST['walletCZK'];
	$WalletGBP = $_POST['walletGBP'];
	$WalletPLN = $_POST['walletPLN'];
	
	// SQL INJECTION protection
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$pass= htmlentities($pass, ENT_QUOTES, "UTF-8");
	$userName = htmlentities($userName, ENT_QUOTES, "UTF-8");
	$userSurname = htmlentities($userSurname, ENT_QUOTES, "UTF-8");
	$userMail = htmlentities($userMail, ENT_QUOTES, "UTF-8");
	$WalletUSD = htmlentities($WalletUSD, ENT_QUOTES, "UTF-8");
	$WalletEUR = htmlentities($WalletEUR, ENT_QUOTES, "UTF-8");
	$WalletCHF = htmlentities($WalletCHF, ENT_QUOTES, "UTF-8");
	$WalletRUB = htmlentities($WalletRUB, ENT_QUOTES, "UTF-8");
	$WalletCZK = htmlentities($WalletCZK, ENT_QUOTES, "UTF-8");
	$WalletGBP = htmlentities($WalletGBP, ENT_QUOTES, "UTF-8");
	$WalletPLN = htmlentities($WalletPLN, ENT_QUOTES, "UTF-8");
	
	$db = new Database();		//create new database object
	
	$result = $db -> createDatabase();		// call function createDatabase(this can be first time and there could not be any database)
	
	if (false == $result)		// function got false, we cannot create database
	{
		$_SESSION['error'] = "Can not create database!";
		header('location:index.php');
		exit;
	}
	
	$result = $db -> checkUser($login);		//check if there's such login
	
	if (false == $result)		// if got false because user exists
	{
		$_SESSION['error'] =  '<span style="color:red">Login already exists. Try another one.</span>';		// set session error and display in index.php
		header('location:index.php');
		exit;			//exit to avoid redundant code 
	}
	
	$result = $db -> registerUser($userName, $userSurname, $login, $pass, $userMail, $WalletUSD, $WalletEUR, $WalletCHF, $WalletRUB, $WalletCZK, $WalletGBP, $WalletPLN);		//call function registerUser and set session error as positive or echo mistake

	if(false == $result)
	{
		echo "Unable to register.";
	}
	
	$_SESSION['error'] = '<span style="color:yellow">User '.$login.' registered!</span>';
	header('location:index.php');
?>