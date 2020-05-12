<?php

$host = "localhost";
$db_user = "ecounter";
$db_password = "OSbG9sqoq%tu";
$db_name = "ecounter_usersdatabase";
$tableName = "users";
$connection = mysqli_connect($host,$db_user,$db_password, $db_name);

session_start();

$login = $_SESSION['login'];
$query = mysqli_query($connection, "SELECT * FROM $tableName WHERE login='$login'");
$queryRow = mysqli_fetch_row($query);
$walletPLN = floatval($queryRow[12]);
$buyEUR = floatval($_POST['buyEUR']);
$buyPriceEUR = floatval($_POST['buyPriceEUR']);;
$valuePLN = floatval($buyEUR * $buyPriceEUR);

if($valuePLN > $walletPLN )
{
    $_SESSION['error'] = '<span style="color:red">Niestety, brakuje wystarczających środków w portfelu.</span>';
}
else
{
    $queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
    $queryAddEUR = mysqli_query($connection, "UPDATE users SET walletEUR = walletEUR + $buyEUR WHERE login='$login'");
}
header('Location: ../index.php');
?>