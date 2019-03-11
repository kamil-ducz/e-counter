<?php
	session_start();
	
		if(isset($_SESSION['login'])) $logged = $_SESSION['login'];
		require_once('connect.php');
		
		$link = mysqli_connect($host, $db_user, $db_password);
		mysqli_select_db($link, "usersdatabase");
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta Content-Type = "application/json" charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Pieprzony Rayback</title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" href="css/style.css" type="text/css">		<!-- including stylesheet for index.php -->
    <link rel="stylesheet" href="css/fontello.css" type="text/css">		<!-- including fontello-->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> 	<!-- including google fonts -->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</head>


<body>

    <form name="hiddenForm" id="hiddenForm" method="POST" action="index.php">
        <input type="text" name="valueUSD" id="valueUSD"/>
        <input type="text" name="valueEUR" />
        <input type="text" name="valueCHF" />
        <input type="text" name="valueRUB" />
        <input type="text" name="valueCZK" />
        <input type="text" name="valueGBP" />

        <input type="text" name="valueUSD2" />
        <input type="text" name="valueEUR2" />
        <input type="text" name="valueCHF2" />
        <input type="text" name="valueRUB2" />
        <input type="text" name="valueCZK2" />
        <input type="text" name="valueGBP2" />
        <input type="submit" id="superGuzik" value="submituj" />
        <input type="button" id="hiddenFormButton" value="guzik" />
    </form>

    <div id="container">

        <div class="top_panel">
        <?php if(!isset($_SESSION['login']))
            echo "Welcome! Log in to buy or sell available units.\n Warning: program uses database.";
            else
                echo "Welcome again in our E-Counter!";
            ?>

        </div>

        <?php

        if (true == isset($_SESSION['login']))
        {

            ?><!-- if logged do the html code from here... -->
            <div class="log_buttons">
            Logged as <?php echo  $_SESSION['login']?>
            <a href="userSettings.php"><i align="right" class="icon-cog "></i></a>
            <a href="logout.php"><i align="right" class="icon-power"></i></a>
            </br>
            <?php
            if(isset($_SESSION['error']))
            {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>
            </div>			<!-- to here.-->
        <?php

        }
        else
        {
        ?><!-- if not logged show panel for log in and registration-->
        <div class="log_panel">
            <form action="proceedLoginData.php" method="post">

            Pieprzony login
            <input type="text" name="login" /> <br />
            Pieprzone hasło
            <input type="password" name="password" />

            <input type="submit" value="Login" /><br/>
            </form>
            <a href="registrationForm.php">Register new user</a>


        <?php			// show error when wrong login and password are given by user

            if(isset($_SESSION['error']))			// session error exists - display it
            {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }

            ?>
        </div>
            <?php
        }
        ?>

        <div style="clear:both"></div>	<!-- clearing atribute float:left -->

    <!--STARTOF BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING -->
        <div class="currencies">		<!-- we buy units here -->
        Currencies	<br />

        <div id ="lastUpdate"> </div>

            <table border="1">
                <tr bgcolor="#666666">
                    <td>Currency</td>
                    <td>Unit</td>
                    <td>Value</td>
                    <td>Actions</td>
                </tr>
    <!-- valueUSD2 means buying, all 2 values to buy -->
                <tr>
                    <td id="code1"></td>
                    <td id="unit1"></td>
                    <td id="purchasePrice1">
                    <?php
                    if(isset($_SESSION['login']))
                    $_SESSION['valueUSD2'] = $_POST['valueUSD2'];

                    ?>
                    </td>
                    <td><input type="button" id="buyUSD" onclick="operationsUSD2()" value="Buy"></td>
                </tr>

                <tr>
                    <td id="code2"></td>
                    <td id="unit2"></td>
                    <td id="purchasePrice2"><?php
                    if(isset($_SESSION['login']))
                    $_SESSION['valueEUR2'] = $_POST['valueEUR2'];
                    ?></td>
                    <td><input type="button" id="buyEUR" onclick="operationsEUR2()"  value="Buy"></td>
                </tr>

                <tr>
                    <td id="code3"></td>
                    <td id="unit3"></td>
                    <td id="purchasePrice3">
                    <?php
                    if(isset($_SESSION['login']))
                    $_SESSION['valueCHF2'] = $_POST['valueCHF2'];
                    ?></td>
                    <td><input type="button" id="buyCHF" onclick="operationsCHF2()"  value="Buy"></td>
                </tr>

                <tr>
                    <td id="code4"></td>
                    <td id="unit4"></td>
                    <td id="purchasePrice4">
                    <?php
                    if(isset($_SESSION['login']))
                    $_SESSION['valueRUB2'] = $_POST['valueRUB2'];
                    ?></td>
                    <td><input type="button" id="buyRUB" onclick="operationsRUB2()"  value="Buy"></td>
                </tr>

                <tr>
                    <td id="code5"></td>
                    <td id="unit5"></td>
                    <td id="purchasePrice5">
                    <?php
                    if(isset($_SESSION['login']))
                    $_SESSION['valueCZK2'] = $_POST['valueCZK2'];
                    ?></td>
                    <td><input type="button" id="buyCZK" onclick="operationsCZK2()"  value="Buy"></td>
                </tr>

                <tr>
                    <td id="code6"></td>
                    <td id="unit6"></td>
                    <td id="purchasePrice6">
                    <?php
                    if(isset($_SESSION['login']))
                    $_SESSION['valueGBP2'] = $_POST['valueGBP2'];
                    ?></td>
                    <td><input type="button" id="buyGBP" onclick="operationsGBP2()"  value="Buy"></td>
                 </tr>

            </table>
        </div>
    <!--ENDOF BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING BUYING -->

    <!--STARTOF SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING -->
        <div class="my_wallet">
        <br />My Wallet:
            <table border="1" id="tableSell">

                <tr bgcolor="#666666">
                    <td>Currency</td>
                    <td>Unit Price</td>
                    <td bgcolor="lightblue">Amount</td>
                    <td>Value</td>
                    <td>Actions</td>
                </tr>

                <tr>
                    <td id="codeb1"></td>
                    <td id="sellPrice1">5.83</td>
                    <td>
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$logged'");
                    $row = mysqli_fetch_row($result);
                                                            echo $row[6];
                    }
                    ?>
                    </td>

                    <td id="value1">
                    <?php
                    if(isset($_SESSION['login']))
                    {
                                                             $courseUSD = filter_input(INPUT_POST, 'valueUSD');
                                                             $walUSD = $_SESSION['walletUSD'];
                                                            $_SESSION['valueUSD'] = filter_input(INPUT_POST, 'valueUSD');
                                                            $realVal = $courseUSD * $walUSD;
                                                            echo $realVal;
                    }
                    ?>
                    </td>
                    <td><input type="button" name="sellUSD" onclick="operationsUSD();" value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeb2"></td>
                    <td id="sellPrice2"></td>
                    <td>
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$logged'");
                    $row = mysqli_fetch_row($result);
                    echo $row[7];
                    }
                    ?></td>
                    <td id="value2">

                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $_SESSION['valueEUR'] = $_POST['valueEUR'];
                    $realVal = $_SESSION['valueEUR'] * $_SESSION['walletEUR'];
                    echo $realVal;
                    }
                    ?>

                    </td>
                    <td><input type="button" id="sellEUR" onclick="operationsEUR();"  value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeb3"></td>
                    <td id="sellPrice3"></td>
                    <td>
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$logged'");
                    $row = mysqli_fetch_row($result);


                        echo $row[8];
                    }
                    ?></td>
                    <td id="value3">
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $_SESSION['valueCHF'] = $_POST['valueCHF'];
                    $realVal = $_SESSION['valueCHF'] * $_SESSION['walletCHF'];
                    echo $realVal;
                    }
                    ?>
                    </td>
                    <td><input type="button" id="sellCHF" onclick="operationsCHF();"   value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeb4"></td>
                    <td id="sellPrice4"></td>
                    <td>
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$logged'");
                    $row = mysqli_fetch_row($result);


                        echo $row[9];
                    }
                    ?></td>
                    <td id="value4">
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $_SESSION['valueRUB'] = $_POST['valueRUB'];
                    $realVal = $_SESSION['valueRUB'] * $_SESSION['walletRUB'];
                    echo $realVal;
                    }
                    ?>
                    </td>
                    <td><input type="button" id="sellRUB" onclick="operationsRUB();"   value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeb5"></td>
                    <td id="sellPrice5">3.70</td>
                    <td>
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$logged'");
                    $row = mysqli_fetch_row($result);
                    echo $row[10];
                    }


                    ?></td>
                    <td id="value5">
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $_SESSION['valueCZK'] = $_POST['valueCZK'];
                    $realVal = $_SESSION['valueCZK'] * $_SESSION['walletCZK'];
                    echo $realVal;
                    }
                    ?>
                    </td>
                    <td><input type="button" id="sellCZK" onclick="operationsCZK();"   value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeb6"></td>
                    <td id="sellPrice6"></td>
                    <td>
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$logged'");
                    $row = mysqli_fetch_row($result);
                    echo $row[11];
                    }
                    ?></td>
                    <td id="value6">
                    <?php
                    if(isset($_SESSION['login']))
                    {
                    $_SESSION['valueGBP'] = $_POST['valueGBP'];
                    $realVal = $_SESSION['valueGBP'] * $_SESSION['walletGBP'];
                    echo $realVal;
                    }
                    ?>
                    </td>
                    <td><input type="button" id="sellGBP" onclick="operationsGBP();"   value="Sell"></td>
                </tr>


            </table>

        </div>
        <!--ENDOF SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING -->


        <div style="clear:both"></div>	<!-- clearing atribute float:left -->

        <div class="blank_rectangle">
        </div>

        <div style="clear:both"></div>  <!-- clearing atribute float:left -->

        <div class="graph">
            <u>Graph presenting last 20 courses(extra):</u>
            <br />

            <form name="sellForm" id="sellForm" action="sellOperation.php" method="POST">
                <input type="" name="sellUSD" />
                <input type="" name="sellEUR" />
                <input type="" name="sellCHF" />
                <input type="" name="sellRUB" />
                <input type="" name="sellCZK" />
                <input type="" name="sellGBP" /> <br />
            </form>

            <form name="buyForm" id="buyForm" action="buyOperation.php" method="POST">
                <input type="" name="buyUSD" />
                <input type="" name="buyEUR" />
                <input type="" name="buyCHF" />
                <input type="" name="buyRUB" />
                <input type="" name="buyCZK" />
                <input type="" name="buyGBP" /> <br />
            </form>

        </div>

        <div class="available_money">
            <?php
            if(isset($_SESSION['login']))
            {
            $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$logged'");
            $row = mysqli_fetch_row($result);

                echo "Available PLN:".$row[12];
            }
            else echo "Log in to check your available money.";
            ?>
        </div>

    </div>

</body>
</html>
