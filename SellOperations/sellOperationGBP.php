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