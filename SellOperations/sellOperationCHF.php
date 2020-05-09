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
$queryWalletCHF = mysqli_query($con, "SELECT walletCHF FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletCHF = mysqli_fetch_row($queryWalletCHF);
$sellCHF = $_POST['sellCHF'];
$sellPriceCHF = $_POST['sellPriceCHF'];
$valuePLN = $sellCHF * $sellPriceCHF;
$valuePLN = $valuePLN;

$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
$queryAddCHF = mysqli_query($con, "UPDATE users SET walletCHF = walletCHF - $sellCHF WHERE login='$login'");

header('Location: ../index.php');
?>