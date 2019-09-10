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
$queryWalletCZK = mysqli_query($con, "SELECT walletCZK FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletCZK = mysqli_fetch_row($queryWalletCZK);
$buyCZK = $_POST['buyCZK'];
$buyCZK = floatval($buyCZK);
$buyPriceCZK = $_POST['buyPriceCZK'];
$buyPriceCZK = floatval($buyPriceCZK);
$valuePLN = $buyCZK * $buyPriceCZK;
$valuePLN = floatval($valuePLN);

//actual calculation on database
$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddCZK = mysqli_query($con, "UPDATE users SET walletCZK = walletCZK + $buyCZK WHERE login='$login'");

header('Location: ../index.php');
?>