<?php

$host = "localhost";
$user = "ecounter";
$pass = "OSbG9sqoq%tu";
$databaseName = "ecounter_usersdatabase";
$tableName = "users";
$con = mysqli_connect($host,$user,$pass, $databaseName);

session_start();

$login = $_SESSION['login'];


$queryWalletPLN = mysqli_query($con, "SELECT walletPLN FROM $tableName WHERE login='$login'");          //query
$queryWalletGBP = mysqli_query($con, "SELECT walletGBP FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletGBP = mysqli_fetch_row($queryWalletGBP);
$sellGBP = $_POST['sellGBP'];
$sellPriceGBP = $_POST['sellPriceGBP'];
$valuePLN = $sellGBP * $sellPriceGBP;
$valuePLN = $valuePLN;

$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
$queryAddGBP = mysqli_query($con, "UPDATE users SET walletGBP = walletGBP - $sellGBP WHERE login='$login'");

header('Location: ../index.php');
?>