<?php

	$host = "localhost";
	$db_user = "ecounter";
	$db_password = "OSbG9sqoq%tu";
	$db_name = "ecounter_usersdatabase";
	$tableName = "users";
	$con = mysqli_connect($host,$user,$pass, $databaseName);

	session_start();

	$login = $_SESSION['login'];

	$result = mysqli_query($con, "SELECT * FROM $tableName WHERE login='$login'");
	$array = mysqli_fetch_row($result);
	echo json_encode($array);

	//header('Location:index.php');
?>