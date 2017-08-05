<?php
session_start();

require_once('connect.php');
$loggedUser = $_SESSION['login'];

//courses and how many were sold

$sellCourseUSD = $_SESSION['valueUSD'];
$sellCourseEUR = $_SESSION['valueEUR'];
$sellCourseCHF = $_SESSION['valueCHF'];
$sellCourseRUB = $_SESSION['valueRUB'];
$sellCourseCZK = $_SESSION['valueCZK'];
$sellCourseGBP = $_SESSION['valueGBP'];

echo $sellCourseUSD;
$sellUSD = $_POST['sellUSD'];
$sellEUR = $_POST['sellEUR'];
$sellCHF = $_POST['sellCHF'];
$sellRUB = $_POST['sellRUB'];
$sellCZK = $_POST['sellCZK'];
$sellGBP = $_POST['sellGBP'];


$link = mysqli_connect($host, $db_user, $db_password);
$usersQuery = "UPDATE users SET walletUSD = walletUSD -'$sellUSD', walletEUR = walletEUR -'$sellEUR', walletCHF = walletCHF -'$sellCHF', walletRUB = walletRUB-'$sellRUB', walletCZK = walletCZK -'$sellCZK', walletGBP = walletGBP -'$sellGBP', walletPLN = walletPLN+'$sellUSD'*'$sellCourseUSD'+'$sellEUR'*'$sellCourseEUR'+'$sellCHF'*'$sellCourseCHF'+'$sellRUB'*'$sellCourseRUB'+'$sellCZK'*'$sellCourseCZK'+'$sellGBP'*'$sellCourseGBP'";


$counterQuery = "UPDATE counter SET counter_money = counter_money - '$sellUSD'";

mysqli_select_db($link, "usersdatabase");

mysqli_query($link, $usersQuery);
mysqli_query($link, $counterQuery);
header('Location:index.php');
?>