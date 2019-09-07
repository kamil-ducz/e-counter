<?php

$host = "localhost";
$user = "root";
$pass = "";
$databaseName = "usersdatabase";
$tableName = "users";
$con = mysqli_connect($host,$user,$pass, $databaseName);

session_start();

$login = $_SESSION['login'];

//DEBUG check before update
$queryPLN = mysqli_query($con, "SELECT walletPLN FROM $tableName WHERE login='$login'");          //query
$rowPLN = mysqli_fetch_row($queryPLN);
$sellUSD = $_POST['sellUSD'];
$sellPriceUSD = $_POST['sellPriceUSD'];
print_r($sellUSD);
echo "<br>";
print_r($sellPriceUSD);

echo "<br>Before update: ";
echo json_encode($rowPLN);

//$sellUSDValue = $sellUSD * $

$queryAddPLN = mysqli_query($con, "UPDATE users SET walletPLN = walletPLN + 777 WHERE login='a'");

//DEBUGcheck after update
$queryPLN = mysqli_query($con, "SELECT walletPLN FROM $tableName WHERE login='$login'");
$rowPLN = mysqli_fetch_row($queryPLN);
echo "<br>After update: ";
echo json_encode($rowPLN);




//$PLNObtained = $_SESSION['sellUSD'] 

//$result = mysqli_query($con, "UPDATE walletPLN FROM $tableName SET walletPLN += 'PLNObtained' WHERE login='$login'");
//$array = mysqli_fetch_row($result);
//echo json_encode($array);
?>