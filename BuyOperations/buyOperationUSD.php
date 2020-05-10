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
$queryWalletUSD = mysqli_query($connection, "SELECT walletUSD FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletUSD = mysqli_fetch_row($queryWalletUSD);
$buyUSD = $_POST['buyUSD'];
$buyUSD = floatval($buyUSD);
$buyPriceUSD = $_POST['buyPriceUSD'];
$buyPriceUSD = floatval($buyPriceUSD);
$valuePLN = $buyUSD * $buyPriceUSD;
$valuePLN = floatval($valuePLN);
print_r($buyUSD);
echo "<br>";
print_r($buyPriceUSD);
echo "<br>";
echo "PLN value = ".$valuePLN; 

//DEBUG check before update
echo "<br>Before update: ";
echo "Wallet PLN: ";
echo json_encode($rowWalletPLN);
echo "<br>Wallet USD: ";
echo json_encode($rowWalletUSD);

//actual calculation on database
$queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
$queryAddUSD = mysqli_query($connection, "UPDATE users SET walletUSD = walletUSD + $buyUSD WHERE login='$login'");

//DEBUGcheck after update
$queryWalletPLN = mysqli_query($connection, "SELECT walletPLN FROM $tableName WHERE login='$login'");          //query
$queryWalletUSD = mysqli_query($connection, "SELECT walletUSD FROM $tableName WHERE login='$login'");          //query
$rowWalletPLN = mysqli_fetch_row($queryWalletPLN);
$rowWalletUSD = mysqli_fetch_row($queryWalletUSD);
echo "<br>After update: ";
echo "Wallet PLN: ";
echo json_encode($rowWalletPLN);
echo "<br>Wallet USD: ";
echo json_encode($rowWalletUSD);

header('Location: ../index.php');
?>