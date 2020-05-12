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
$walletPLN = floatval($queryRow[12]);
$buyCHF = floatval($_POST['buyCHF']);
$buyPriceCHF = floatval($_POST['buyPriceCHF']);;
$valuePLN = floatval($buyCHF * $buyPriceCHF);

if($valuePLN > $walletPLN )
{
    $_SESSION['error'] = '<span style="color:red">Niestety, brakuje wystarczających środków w portfelu.</span>';
}
else
{
    $queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
    $queryAddCHF = mysqli_query($connection, "UPDATE users SET walletCHF = walletCHF + $buyCHF WHERE login='$login'");
}
header('Location: ../index.php');
?>