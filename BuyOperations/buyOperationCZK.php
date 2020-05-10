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
$queryWalletCZK = mysqli_query($connection, "SELECT walletCZK FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletCZK = mysqli_fetch_row($queryWalletCZK);
$buyCZK = $_POST['buyCZK'];
$buyCZK = floatval($buyCZK);
$buyPriceCZK = $_POST['buyPriceCZK'];
$buyPriceCZK = floatval($buyPriceCZK);
$valuePLN = $buyCZK * $buyPriceCZK;
$valuePLN = floatval($valuePLN);

//actual calculation on database
$queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddCZK = mysqli_query($connection, "UPDATE users SET walletCZK = walletCZK + $buyCZK WHERE login='$login'");

header('Location: ../index.php');
?>