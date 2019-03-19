<?php
	session_start();
	
	
	//require_once("database.php");
	
	//when user is logged it's impossible to register new user
	if(isset($_SESSION['login']))	
	{
		header("Location:index.php");
		exit();
	}

	require_once('database.php');
	
	
	$login = $_POST['login'];			//login and password sent from form 
	$pass = $_POST['password'];
	
	//MYSQL INJECTION PROTECT
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$pass = htmlentities($pass, ENT_QUOTES, "UTF-8");
	
	$db = new Database();
	
	$result = $db -> createDatabase();
	
	if (false == $result)
	{
		$_SESSION['error'] = "Can not create database!";
		header('Location: index.php');
		exit;
	}
	
	$result = $db -> loginCheck($login, $pass);
	
	if (true == $result)
	{

	}
	else
	{
		$_SESSION['error'] = '<span style="color:red">Wrong login or password</span>';
		header('Location: index.php');
		exit;
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