<?php

$host = "localhost";
$user = "root";
$pass = "";
$databaseName = "usersdatabase";
$tableName = "users";
$connection = mysqli_connect($host,$user,$pass, $databaseName);

session_start();

$login = $_SESSION['login'];
$query = mysqli_query($connection, "SELECT * FROM $tableName WHERE login='$login'");
$queryRow = mysqli_fetch_row($query);
$walletGBP = floatval($queryRow[11]);
$sellGBP = floatval($_POST['sellGBP']);
$sellPriceGBP = floatval($_POST['sellPriceGBP']);;
$valuePLN = floatval($sellGBP * $sellPriceGBP);

if($sellGBP > $walletGBP )
{
    $_SESSION['error'] = '<span style="color:red">Niestety, nie posiadasz aż tyle waluty.</span>';
}
else
{
    $queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
    $queryAddGBP = mysqli_query($connection, "UPDATE users SET walletGBP = walletGBP - $sellGBP WHERE login='$login'");
}

header('Location: ../index.php');
?>