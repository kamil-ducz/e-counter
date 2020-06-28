<?php
	session_start();


    $host = "localhost";
	$db_user = "ecounter";
	$db_password = "OSbG9sqoq%tu";
    $db_name = "ecounter_usersdatabase";
    $connection = mysqli_connect($host, $db_user, $db_password, $db_name);


    $query = 'SELECT AVG(buy_USD_course) AS averageBuyUSD, AVG(buy_EUR_course) as averageBuyEUR, AVG(buy_CHF_course) as averageBuyCHF, AVG(buy_RUB_course)/100 as averageBuyRUB, AVG(buy_CZK_course)/100 as averageBuyCZK, AVG(buy_GBP_course) as averageBuyGBP, AVG(sell_USD_course) as averageSellUSD, AVG(sell_EUR_course) as averageSellEUR, AVG(sell_CHF_course) as averageSellCHF, AVG(sell_RUB_course)/100 as averageSellRUB, AVG(sell_CZK_course)/100 as averageSellCZK, AVG(sell_GBP_course) as averageBuyGBP FROM currencies_history WHERE DATE_FORMAT(collection_date, "%Y-%m-%d ") = subdate(current_date, 1)';
    $result=mysqli_query($connection, $query);
    $array = mysqli_fetch_row($result);
    echo json_encode($array);

?>