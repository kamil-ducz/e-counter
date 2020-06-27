<?php
	session_start();


    $host = "localhost";
	$db_user = "root";
	$db_password = "";
    $db_name = "usersdatabase";
    $connection = mysqli_connect($host, $db_user, $db_password, $db_name);


    $query = 'SELECT AVG(buy_USD_course) AS averageUSD, AVG(buy_EUR_course) as averageEUR, AVG(buy_CHF_course) as averageCHF, AVG(buy_RUB_course) as averageRUB, AVG(buy_CZK_course) as averageCZK, AVG(buy_GBP_course) as averageGBP FROM currencies_history WHERE DATE_FORMAT(collection_date, "%Y-%m-%d ") = subdate(current_date, 1)';
    $result=mysqli_query($connection, $query);
    $array = mysqli_fetch_row($result);
    echo json_encode($array);

?>