<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "usersdatabase";
$tableName = "users";
$connection = mysqli_connect($host,$db_user,$db_password, $db_name);

session_start();

$login = $_SESSION['login'];


$queryWalletPLN = mysqli_query($connection, "SELECT walletPLN FROM $tableName WHERE login='$login'");          //query
$queryWalletRUB = mysqli_query($connection, "SELECT walletRUB FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletRUB = mysqli_fetch_row($queryWalletRUB);
$buyRUB = $_POST['buyRUB'];
$buyRUB = floatval($buyRUB);
$buyPriceRUB = $_POST['buyPriceRUB'];
$buyPriceRUB = floatval($buyPriceRUB);
$valuePLN = $buyRUB * $buyPriceRUB;
$valuePLN = floatval($valuePLN);

//actual calculation on database
$queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddRUB = mysqli_query($connection, "UPDATE users SET walletRUB = walletRUB + $buyRUB WHERE login='$login'");

header('Location: ../index.php');
?>