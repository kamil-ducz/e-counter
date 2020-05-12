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
$walletCHF = floatval($queryRow[8]);
$sellCHF = floatval($_POST['sellCHF']);
$sellPriceCHF = floatval($_POST['sellPriceCHF']);;
$valuePLN = floatval($sellCHF * $sellPriceCHF);

if($sellCHF > $walletCHF )
{
    $_SESSION['error'] = '<span style="color:red">Niestety, nie posiadasz aż tyle waluty.</span>';
}
else
{
    $queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
    $queryAddCHF = mysqli_query($connection, "UPDATE users SET walletCHF = walletCHF - $sellCHF WHERE login='$login'");
}

header('Location: ../index.php');
?>