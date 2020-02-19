<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf8" />
<meta httpequiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
<title>Personal Settings</title>
</head>

<body>
<?php
	session_start();
	
	if (false == isset($_SESSION['login']))
	{
		header("Location:index.php");
		exit;
	}
	
	require_once('database.php');
	
	$db = new Database();	
	
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['password']  = $_POST['password'];
	$_SESSION['name']  = $_POST['userName'];
	$_SESSION['surname']  = $_POST['userSurname'];
	$_SESSION['mail']  = $_POST['mail'];
	
	$result = $db ->updateUser($_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['mail'], $_SESSION['login']);
	
	if (true == $result)
	{
		$_SESSION['error'] = "User updated!";
	}
	else
	{
		$_SESSION['error'] = "Can not update user settings!";
	}
	header("Location:index.php");
	
	
?>

</body>

</html>