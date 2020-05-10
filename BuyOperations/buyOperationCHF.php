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
$queryWalletCHF = mysqli_query($connection, "SELECT walletCHF FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletCHF = mysqli_fetch_row($queryWalletCHF);
$buyCHF = $_POST['buyCHF'];
$buyCHF = floatval($buyCHF);
$buyPriceCHF = $_POST['buyPriceCHF'];
$buyPriceCHF = floatval($buyPriceCHF);
$valuePLN = $buyCHF * $buyPriceCHF;
$valuePLN = floatval($valuePLN);

//actual calculation on database
$queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddCHF = mysqli_query($connection, "UPDATE users SET walletCHF = walletCHF + $buyCHF WHERE login='$login'");

header('Location: ../index.php');
?>