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
$queryWalletUSD = mysqli_query($con, "SELECT walletUSD FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletUSD = mysqli_fetch_row($queryWalletUSD);
$sellUSD = $_POST['sellUSD'];
$sellUSD = floatval($sellUSD);
$sellPriceUSD = $_POST['sellPriceUSD'];
$sellPriceUSD = floatval($sellPriceUSD);
$valuePLN = $sellUSD * $sellPriceUSD;
$valuePLN = floatval($valuePLN);
print_r($sellUSD);
echo "<br>";
print_r($sellPriceUSD);
echo "<br>";
echo "PLN value = " + floatval($valuePLN); 

//DEBUG check before update
echo "<br>Before update: ";
echo "Wallet PLN: ";
echo json_encode($rowWalletPLN);
echo "<br>Wallet USD: ";
echo json_encode($rowWalletUSD);

//actual calculation on database
$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
$queryAddUSD = mysqli_query($con, "UPDATE users SET walletUSD = walletUSD - $sellUSD WHERE login='$login'");

//DEBUGcheck after update
$queryWalletPLN = mysqli_query($con, "SELECT walletPLN FROM $tableName WHERE login='$login'");          //query
$queryWalletUSD = mysqli_query($con, "SELECT walletUSD FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletUSD = mysqli_fetch_row($queryWalletUSD);
echo "<br>After update: ";
echo "Wallet PLN: ";
echo json_encode($rowWalletPLN);
echo "<br>Wallet USD: ";
echo json_encode($rowWalletUSD);

header('Location: ../index.php');
?>