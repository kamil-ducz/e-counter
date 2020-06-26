<?php

    //open connection to database usersdatabase and table currencies_history and fill with below data
	session_start();

    // require_once("database.php");
    // $db = new Database();

	$host = "localhost";
	$db_user = "ecounter";
	$db_password = "OSbG9sqoq%tu";
	$db_name = "ecounter_usersdatabase";
    $connection = mysqli_connect($host, $db_user, $db_password, $db_name);
    $purchasePrice1 = $_POST["purchasePrice1"];
    $purchasePrice2 = $_POST["purchasePrice2"];
    $purchasePrice3 = $_POST["purchasePrice3"];
    $purchasePrice4 = $_POST["purchasePrice4"];
    $purchasePrice5 = $_POST["purchasePrice5"];
    $purchasePrice6 = $_POST["purchasePrice6"];

    $sellPrice1 = $_POST["sellPrice1"];
    $sellPrice2 = $_POST["sellPrice2"];
    $sellPrice3 = $_POST["sellPrice3"];
    $sellPrice4 = $_POST["sellPrice4"];
    $sellPrice5 = $_POST["sellPrice5"];
    $sellPrice6 = $_POST["sellPrice6"];

    $query = 'INSERT INTO currencies_history(buy_USD_course, buy_EUR_course, buy_CHF_course, buy_RUB_course, buy_CZK_course, buy_GBP_course, sell_USD_course, sell_EUR_course, sell_CHF_course, sell_RUB_course, sell_CZK_course, sell_GBP_course) 
    VALUES ("'.$purchasePrice1.'", "'.$purchasePrice2.'", "'.$purchasePrice3.'", "'.$purchasePrice4.'", "'.$purchasePrice5.'", "'.$purchasePrice6.'", "'.$sellPrice1.'", "'.$sellPrice2.'", "'.$sellPrice3.'", "'.$sellPrice4.'", "'.$sellPrice5.'", "'.$sellPrice6.'")'; 

    $result = mysqli_query($connection, $query);
    //$result = mysqli_query($this -> connection, $query);




    $file=fopen("log.txt","a+") or exit("Unable to open file!");

    fwrite($file,$_POST["logTime"].",");
    fwrite($file,$_POST["purchasePrice1"].",");
    fwrite($file,$_POST["purchasePrice2"].",");
    fwrite($file,$_POST["purchasePrice3"].",");
    fwrite($file,$_POST["purchasePrice4"].",");
    fwrite($file,$_POST["purchasePrice5"].",");
    fwrite($file,$_POST["purchasePrice6"].",");

    fwrite($file,$_POST["sellPrice1"].",");
    fwrite($file,$_POST["sellPrice2"].",");
    fwrite($file,$_POST["sellPrice3"].",");
    fwrite($file,$_POST["sellPrice4"].",");
    fwrite($file,$_POST["sellPrice5"].",");
    fwrite($file,$_POST["sellPrice6"]."\n");

    fclose($file);
?>