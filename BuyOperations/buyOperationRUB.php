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
$queryWalletRUB = mysqli_query($con, "SELECT walletRUB FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletRUB = mysqli_fetch_row($queryWalletRUB);
$buyRUB = $_POST['buyRUB'];
$buyRUB = floatval($buyRUB);
$buyPriceRUB = $_POST['buyPriceRUB'];
$buyPriceRUB = floatval($buyPriceRUB);
$valuePLN = $buyRUB * $buyPriceRUB;
$valuePLN = floatval($valuePLN);

//actual calculation on database
$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddRUB = mysqli_query($con, "UPDATE users SET walletRUB = walletRUB + $buyRUB WHERE login='$login'");

header('Location: ../index.php');
?>