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
$buyUSD = floatval($_POST['buyUSD']);
$buyPriceUSD = floatval($_POST['buyPriceUSD']);;
$valuePLN = floatval($buyUSD * $buyPriceUSD);
//DEBUG before update
echo "przed aktualizacja <br>";
echo "buyUSD: ".$buyUSD." is of type: ".gettype($buyUSD)." <br>";
echo "buyPriceUSD: ".$buyPriceUSD." is of type: ".gettype($buyPriceUSD)." <br>";
echo "valuePLN: ".$valuePLN." is of type: ".gettype($valuePLN)." <br>"; 
echo "walletPLN: ".$walletPLN." is of type: ".gettype($walletPLN)." <br>"; 
//actual calculation on database
if($valuePLN > $walletPLN )
{
    $_SESSION['error'] = '<span style="color:red">Niestety, brakuje wystarczających środków w portfelu.</span>';
}
else
{
    $queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN - $valuePLN WHERE login='$login'");
    $queryAddUSD = mysqli_query($connection, "UPDATE users SET walletUSD = walletUSD + $buyUSD WHERE login='$login'");
}
//DEBUG after update
echo "<br> po aktualizacji <br>";
echo "buyUSD: ".$buyUSD." is of type: ".gettype($buyUSD)." <br>";
echo "buyPriceUSD: ".$buyPriceUSD." is of type: ".gettype($buyPriceUSD)." <br>";
echo "valuePLN: ".$valuePLN." is of type: ".gettype($valuePLN)." <br>"; 
echo "walletPLN: ".$walletPLN." is of type: ".gettype($walletPLN)." <br>"; 

header('Location: ../index.php');
?>