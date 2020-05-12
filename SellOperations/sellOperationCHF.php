<?php

$$host = "localhost";
$db_user = "ecounter";
$db_password = "OSbG9sqoq%tu";
$db_name = "ecounter_usersdatabase";
$tableName = "users";
$connection = mysqli_connect($host,$db_user,$db_password, $db_name);

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