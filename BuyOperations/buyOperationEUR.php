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
$queryWalletEUR = mysqli_query($connection, "SELECT walletEUR FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletEUR = mysqli_fetch_row($queryWalletEUR);
$buyEUR = $_POST['buyEUR'];
$buyEUR = floatval($buyEUR);
$buyPriceEUR = $_POST['buyPriceEUR'];
$buyPriceEUR = floatval($buyPriceEUR);
$valuePLN = $buyEUR * $buyPriceEUR;
$valuePLN = floatval($valuePLN);

//actual calculation on database
$queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddEUR = mysqli_query($connection, "UPDATE users SET walletEUR = walletEUR + $buyEUR WHERE login='$login'");

header('Location: ../index.php');
?>