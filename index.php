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
    <script language="javascript" type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script language="javascript" type="text/javascript" src="script.js?newversion"></script>
</head>


<body>

    <form name="hiddenForm" id="hiddenForm" method="POST" action="index.php">
        <input type="hidden" name="valueUSD" id="valueUSD"/>
        <input type="hidden" name="valueEUR" />
        <input type="hidden" name="valueCHF" />
        <input type="hidden" name="valueRUB" />
        <input type="hidden" name="valueCZK" />
        <input type="hidden" name="valueGBP" />

        <input type="hidden" name="valueUSD2" />
        <input type="hidden" name="valueEUR2" />
        <input type="hidden" name="valueCHF2" />
        <input type="hidden" name="valueRUB2" />
        <input type="hidden" name="valueCZK2" />
        <input type="hidden" name="valueGBP2" />
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
            Logged as 
            
            <?php echo  $_SESSION['login']?>
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

            Login
            <input type="text" name="login" /> <br />
            Password
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
                    <td>We buy at</td>
                    <td>Actions</td>
                </tr>
    <!-- valueUSD2 means buying, all 2 values to buy -->
                <tr>
                    <td id="code1"></td>
                    <td id="unit1"></td>
                    <td id="purchasePrice1"></td>
                    <td><input type="button" id="buyUSD" onclick="operationsUSD2()" value="Buy"></td>
                </tr>

                <tr>
                    <td id="code2"></td>
                    <td id="unit2"></td>
                    <td id="purchasePrice2"></td>
                    <td><input type="button" id="buyEUR" onclick="operationsEUR2()"  value="Buy"></td>
                </tr>

                <tr>
                    <td id="code3"></td>
                    <td id="unit3"></td>
                    <td id="purchasePrice3"></td>
                    <td><input type="button" id="buyCHF" onclick="operationsCHF2()"  value="Buy"></td>
                </tr>

                <tr>
                    <td id="code4"></td>
                    <td id="unit4"></td>
                    <td id="purchasePrice4"></td>
                    <td><input type="button" id="buyRUB" onclick="operationsRUB2()"  value="Buy"></td>
                </tr>

                <tr>
                    <td id="code5"></td>
                    <td id="unit5"></td>
                    <td id="purchasePrice5"></td>
                    <td><input type="button" id="buyCZK" onclick="operationsCZK2()"  value="Buy"></td>
                </tr>

                <tr>
                    <td id="code6"></td>
                    <td id="unit6"></td>
                    <td id="purchasePrice6"></td>
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
                    <td>We buy at</td>
                    <td bgcolor="lightblue">Amount</td>
                    <td>Value</td>
                    <td>Actions</td>
                    <td>Finalize</td>
                </tr>

                <tr>
                    <form name="sellUSDForm" method="POST" action="sellOperation.php">

                        <td id="codeSale1"></td>
                        <td id="sellPrice1"></td><input type="hidden" name="sellPriceUSD">                     
                        <td id="amountWallet1"></td>
                        <td id="walletValue1"></td>
                        <td>
                            <input type="text" name="sellUSD" value="enter dollars">                                                        
                        </td>
                        <td><input type="submit" id="USDSubmit" value="SellUSD"></td>                         
                    </form>
                </tr>

                <tr>
                    <td id="codeSale2"></td>
                    <td id="sellPrice2"></td>
                    <td id="amountWallet2"></td>
                    <td id="walletValue2"></td>
                    <td><input type="button" id="sellEUR" onclick="operationsEUR();"  value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeSale3"></td>
                    <td id="sellPrice3"></td>
                    <td id="amountWallet3"></td>
                    <td id="walletValue3"></td>
                    <td><input type="button" id="sellCHF" onclick="operationsCHF();"   value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeSale4"></td>
                    <td id="sellPrice4"></td>
                    <td id="amountWallet4"></td>
                    <td id="walletValue4"></td>
                    <td><input type="button" id="sellRUB" onclick="operationsRUB();"   value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeSale5"></td>
                    <td id="sellPrice5"></td>
                    <td id="amountWallet5"></td>
                    <td id="walletValue5"></td>
                    <td><input type="button" id="sellCZK" onclick="operationsCZK();"   value="Sell"></td>
                </tr>

                <tr>
                    <td id="codeSale6"></td>
                    <td id="sellPrice6"></td>
                    <td id="amountWallet6"></td>
                    <td id="walletValue6"></td>
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
            $walletPLN = $row[12];

                echo "Wallet PLN: ".$walletPLN. "<br>";
               echo "Total PLN: "?><div id="totalPLN"></div> <?php
            }
            else echo "Log in to check your available money.";
            ?>
            
        </div>

    </div>

</body>
</html>
