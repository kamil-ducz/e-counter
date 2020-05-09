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
$queryWalletEUR = mysqli_query($con, "SELECT walletEUR FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletEUR = mysqli_fetch_row($queryWalletEUR);
$sellEUR = $_POST['sellEUR'];
$sellPriceEUR = $_POST['sellPriceEUR'];
$valuePLN = $sellEUR * $sellPriceEUR;
$valuePLN = $valuePLN;

$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
$queryAddEUR = mysqli_query($con, "UPDATE users SET walletEUR = walletEUR - $sellEUR WHERE login='$login'");

header('Location: ../index.php');
?>