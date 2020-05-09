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
$queryWalletRUB = mysqli_query($con, "SELECT walletRUB FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletRUB = mysqli_fetch_row($queryWalletRUB);
$sellRUB = $_POST['sellRUB'];
$sellPriceRUB = $_POST['sellPriceRUB'];
$valuePLN = $sellRUB * $sellPriceRUB;
$valuePLN = $valuePLN;

$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
$queryAddRUB = mysqli_query($con, "UPDATE users SET walletRUB = walletRUB - $sellRUB WHERE login='$login'");

header('Location: ../index.php');
?>