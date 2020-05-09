<?php

$host = "localhost";
$user = "root";
$pass = "";
$databaseName = "usersdatabase";
$tableName = "users";
$con = mysqli_connect($host,$user,$pass, $databaseName);

session_start();

$login = $_SESSION['login'];


$queryWalletPLN = mysqli_query($con, "SELECT walletPLN FROM $tableName WHERE login='$login'");          //query
$queryWalletGBP = mysqli_query($con, "SELECT walletGBP FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletGBP = mysqli_fetch_row($queryWalletGBP);
$buyGBP = $_POST['buyGBP'];
$buyGBP = floatval($buyGBP);
$buyPriceGBP = $_POST['buyPriceGBP'];
$buyPriceGBP = floatval($buyPriceGBP);
$valuePLN = $buyGBP * $buyPriceGBP;
$valuePLN = floatval($valuePLN);

//actual calculation on database
$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddGBP = mysqli_query($con, "UPDATE users SET walletGBP = walletGBP + $buyGBP WHERE login='$login'");

header('Location: ../index.php');
?>