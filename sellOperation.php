<?php

$host = "localhost";
$user = "root";
$pass = "";
$databaseName = "usersdatabase";
$tableName = "users";
$con = mysqli_connect($host,$user,$pass, $databaseName);

session_start();

$login = $_SESSION['login'];

$result = mysqli_query($con, "SELECT walletPLN FROM $tableName WHERE login='$login'");
$walletPLN = mysqli_fetch_field($result);

$PLNObtained = SESSION_['sellUSD'] 

$result = mysqli_query($con, "UPDATE walletPLN FROM $tableName SET walletPLN += 'PLNObtained' WHERE login='$login'");          //query
$array = mysqli_fetch_row($result);
echo json_encode($array);
?>