<?php
session_start();

//sell
$_SESSION['valueUSD'] = $_POST['valueUSD'];
$_SESSION['valueEUR'] = $_POST['valueEUR'];
$_SESSION['valueCHF'] = $_POST['valueCHF'];
$_SESSION['valueRUB'] = $_POST['valueRUB'];
$_SESSION['valueCZK'] = $_POST['valueCZK'];
$_SESSION['valueGBP'] = $_POST['valueGBP'];

echo $_SESSION['valueUSD'];
//buy
$_SESSION['valueUSD2'] = $_POST['valueUSD2'];
$_SESSION['valueEUR2'] = $_POST['valueEUR2'];
$_SESSION['valueCHF2'] = $_POST['valueCHF2'];
$_SESSION['valueRUB2'] = $_POST['valueRUB2'];
$_SESSION['valueCZK2'] = $_POST['valueCZK2'];
$_SESSION['valueGBP2'] = $_POST['valueGBP2'];
echo $_SESSION['valueUSD2'];
header("Location:index.php");
?>