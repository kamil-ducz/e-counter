<?php

$host = "localhost";
$db_user = "ecounter";
$db_password = "OSbG9sqoq%tu";
$db_name = "ecounter_usersdatabase";
$tableName = "users";
$connection = mysqli_connect($host,$db_user,$db_password, $db_name);

session_start();

$login = $_SESSION['login'];


$queryWalletPLN = mysqli_query($connection, "SELECT walletPLN FROM $tableName WHERE login='$login'");          //query
$queryWalletGBP = mysqli_query($connection, "SELECT walletGBP FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletGBP = mysqli_fetch_row($queryWalletGBP);
$buyGBP = $_POST['buyGBP'];
$buyGBP = floatval($buyGBP);
$buyPriceGBP = $_POST['buyPriceGBP'];
$buyPriceGBP = floatval($buyPriceGBP);
$valuePLN = $buyGBP * $buyPriceGBP;
$valuePLN = floatval($valuePLN);

//actual calculation on database
$queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddGBP = mysqli_query($connection, "UPDATE users SET walletGBP = walletGBP + $buyGBP WHERE login='$login'");

header('Location: ../index.php');
?>