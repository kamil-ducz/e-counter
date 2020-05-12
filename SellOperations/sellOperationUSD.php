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
$walletUSD = floatval($queryRow[6]);
$sellUSD = floatval($_POST['sellUSD']);
$sellPriceUSD = floatval($_POST['sellPriceUSD']);;
$valuePLN = floatval($sellUSD * $sellPriceUSD);
//DEBUG before update
echo "przed aktualizacja <br>";
echo "sellUSD: ".$sellUSD." is of type: ".gettype($sellUSD)." <br>";
echo "sellPriceUSD: ".$sellPriceUSD." is of type: ".gettype($sellPriceUSD)." <br>";
echo "valuePLN: ".$valuePLN." is of type: ".gettype($valuePLN)." <br>"; 
echo "walletUSD: ".$walletUSD." is of type: ".gettype($walletUSD)." <br>";

//actual calculation on database
if($sellUSD > $walletUSD )
{
    $_SESSION['error'] = '<span style="color:red">Niestety, nie posiadasz aż tyle waluty.</span>';
}
else
{
    $queryAddPLN = mysqli_query($connection, "UPDATE users SET walletPLN = walletPLN + $valuePLN WHERE login='$login'");
    $queryAddUSD = mysqli_query($connection, "UPDATE users SET walletUSD = walletUSD - $sellUSD WHERE login='$login'");
}
//DEBUG after update
echo "<br> po aktualizacji <br>";
echo "sellUSD: ".$sellUSD." is of type: ".gettype($sellUSD)." <br>";
echo "sellPriceUSD: ".$sellPriceUSD." is of type: ".gettype($sellPriceUSD)." <br>";
echo "valuePLN: ".$valuePLN." is of type: ".gettype($valuePLN)." <br>"; 
echo "walletPLN: ".$walletUSD." is of type: ".gettype($walletUSD)." <br>"; 

header('Location: ../index.php');
?>