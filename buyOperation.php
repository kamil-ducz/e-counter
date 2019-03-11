<?php
session_start();

require_once('connect.php');
$loggedUser = $_SESSION['login'];

//courses and how many were sold

$buyCourseUSD = $_SESSION['valueUSD2'];
$buyCourseEUR = $_SESSION['valueEUR2'];
$buyCourseCHF = $_SESSION['valueCHF2'];
$buyCourseRUB = $_SESSION['valueRUB2'];
$buyCourseCZK = $_SESSION['valueCZK2'];
$buyCourseGBP = $_SESSION['valueGBP2'];

echo $buyCourseUSD;

$buyUSD = $_POST['buyUSD'];
$buyEUR = $_POST['buyEUR'];
$buyCHF = $_POST['buyCHF'];
$buyRUB = $_POST['buyRUB'];
$buyCZK = $_POST['buyCZK'];
$buyGBP = $_POST['buyGBP'];

echo $_SESSION['valueUSD2'];

	$host = "localhost";
	$db_user = "root";
	$db_password = "";
	$db_name = "usersdatabase";


$link = mysqli_connect($host, $db_user, $db_password, $db_name);
$usersQuery = "UPDATE users SET walletUSD = walletUSD +'$buyUSD', walletEUR = walletEUR +'$buyEUR', walletCHF = walletCHF +'$buyCHF', walletRUB = walletRUB+'$buyRUB', walletCZK = walletCZK +'$buyCZK', walletGBP = walletGBP +'$buyGBP', walletPLN = walletPLN-'$buyUSD'*'$buyCourseUSD'-'$buyEUR'*'$buyCourseEUR'-'$buyCHF'*'$buyCourseCHF'-'$buyRUB'*'$buyCourseRUB'-'$buyCZK'*'$buyCourseCZK'-'$buyGBP'*'$buyCourseGBP'";


//$counterQuery = "UPDATE counter SET counter_money = counter_money - '$sellUSD'";

mysqli_select_db($link, "usersdatabase");

mysqli_query($link, $usersQuery);
//mysqli_query($link, $counterQuery);

header('Location:index.php');
?>