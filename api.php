<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
session_start();
echo "zalogowany uzytkownik: ";
echo $_SESSION['login'];

$host = "localhost";
$user = "root";
$pass = "";

$databaseName = "usersdatabase";
$tableName = "users";

//include 'DB.php';
$con = mysqli_connect($host,$user,$pass, $databaseName);
//$dbs = mysqli_select_db($databaseName, $con);
//echo "user logged: " . $_SESSION['login'];

$result = mysqli_query($con, "SELECT * FROM $tableName WHERE id=2");          //query
$array = mysqli_fetch_row($result);
echo json_encode($array);

?>