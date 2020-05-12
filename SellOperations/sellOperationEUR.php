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
$walletEUR = floatval($queryRow[7]);
$sellEUR = floatval($_POST['sellEUR']);
$sellPriceEUR = floatval($_POST['sellPriceEUR']);;
$valuePLN = floatval($sellEUR * $sellPriceEUR);

if($sellEUR > $walletEUR )
{
    $_SESSION['error'] = '<span style="color:red">Niestety, nie posiadasz aż tyle waluty.</span>';
}
else
{
    $queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
    $queryAddEUR = mysqli_query($connection, "UPDATE users SET walletEUR = walletEUR - $sellEUR WHERE login='$login'");
}

header('Location: ../index.php');
?>