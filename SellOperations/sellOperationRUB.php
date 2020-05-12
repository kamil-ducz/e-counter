<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "usersdatabase";
$tableName = "users";
$connection = mysqli_connect($host,$db_user,$db_password, $db_name);

session_start();

$login = $_SESSION['login'];
$query = mysqli_query($connection, "SELECT * FROM $tableName WHERE login='$login'");
$queryRow = mysqli_fetch_row($query);
$walletRUB = floatval($queryRow[9]);
$sellRUB = floatval($_POST['sellRUB']);
$sellPriceRUB = floatval($_POST['sellPriceRUB']);;
$valuePLN = floatval($sellRUB * $sellPriceRUB);

if($sellRUB > $walletRUB )
{
    $_SESSION['error'] = '<span style="color:red">Niestety, nie posiadasz aż tyle waluty.</span>';
}
else
{
    $queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
    $queryAddRUB = mysqli_query($connection, "UPDATE users SET walletRUB = walletRUB - $sellRUB WHERE login='$login'");
}

header('Location: ../index.php');
?>