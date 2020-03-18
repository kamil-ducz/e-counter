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

    <title>Internetowy System Wymiany Walut</title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" href="css/style.css" type="text/css">		<!-- including stylesheet for index.php -->
    <link rel="stylesheet" href="css/fontello.css" type="text/css">		<!-- including fontello-->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> 	<!-- including google fonts -->
    <!--<script language="javascript" type="text/javascript" src="js/jquery-3.3.1.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="script.js?newversion"></script>
</head>


<body>


    <div id="container">
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
            <td>Purchase price</td>
            <td>Actions</td>
            <td>Finalize</td>
        </tr>
    <!-- valueUSD2 means buying, all 2 values to buy -->
        <tr>
            <form name="buyUSDForm" method="POST" action="../e-counter/BuyOperations/buyOperationUSD.php">

                <td id="code1"></td>
                <td id="unit1"></td><input type="hidden" name="buyPriceUSD">
                <td id="purchasePrice1"></td>                     
                <td>
                    <input type="number" min="0" max="1000000" name="buyUSD" placeholder="enter USD">
                </td>
                <td><input type="submit" id="USDSubmit" value="BuyUSD"></td>                         
            </form>
        </tr>

        <tr>
            <form name="buyEURForm" method="POST" action="../e-counter/BuyOperations/buyOperationEUR.php">

                <td id="code2"></td>
                <td id="unit2"></td><input type="hidden" name="buyPriceEUR">
                <td id="purchasePrice2"></td>                     
                <td>
                    <input type="number" min="0" max="1000000" name="buyEUR" placeholder="enter EUR">
                </td>
                <td><input type="submit" id="EURSubmit" value="BuyEUR"></td>                         
            </form>
        </tr>
        <tr>
            <form name="buyCHFForm" method="POST" action="../e-counter/BuyOperations/buyOperationCHF.php">

                <td id="code3"></td>
                <td id="unit3"></td><input type="hidden" name="buyPriceCHF">
                <td id="purchasePrice3"></td>                     
                <td>
                    <input type="number" min="0" max="1000000" name="buyCHF" placeholder="enter CHF">
                </td>
                <td><input type="submit" id="CHFSubmit" value="BuyCHF"></td>                         
            </form>
        </tr>

        <tr>
            <form name="buyRUBForm" method="POST" action="../e-counter/BuyOperations/buyOperationRUB.php">

                <td id="code4"></td>
                <td id="unit4"></td><input type="hidden" name="buyPriceRUB">
                <td id="purchasePrice4"></td>                     
                <td>
                    <input type="number" min="0" max="1000000" name="buyRUB" placeholder="enter RUB">
                </td>
                <td><input type="submit" id="RUBSubmit" value="BuyRUB"></td>                         
            </form>
        </tr>

        <tr>
            <form name="buyCZKForm" method="POST" action="../e-counter/BuyOperations/buyOperationCZK.php">

                <td id="code5"></td>
                <td id="unit5"></td><input type="hidden" name="buyPriceCZK">
                <td id="purchasePrice5"></td>                     
                <td>
                    <input type="number" min="0" max="1000000" name="buyCZK" placeholder="enter CZK">
                </td>
                <td><input type="submit" id="CZKSubmit" value="BuyCZK"></td>                         
            </form>
        </tr>

        <tr>
            <form name="buyGBPForm" method="POST" action="../e-counter/BuyOperations/buyOperationGBP.php">

                <td id="code6"></td>
                <td id="unit6"></td><input type="hidden" name="buyPriceGBP">
                <td id="purchasePrice6"></td>                     
                <td>
                    <input type="number" min="0" max="1000000" name="buyGBP" placeholder="enter GBP">
                </td>
                <td><input type="submit" id="GBPSubmit" value="BuyGBP"></td>                         
            </form>
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
                    <td>Sell price</td>
                    <td bgcolor="lightblue">Amount</td>
                    <td>Value</td>
                    <td>Actions</td>
                    <td>Finalize</td>
                </tr>

                <tr>
                    <form name="sellUSDForm" method="POST" action="../e-counter/SellOperations/sellOperationUSD.php">

                        <td id="codeSale1"></td>
                        <td id="sellPrice1"></td><input type="hidden" name="sellPriceUSD">                     
                        <td id="amountWallet1"></td>
                        <td id="walletValue1"></td>
                        <td>
                            <input type="number" min="0" max="1000000" name="sellUSD" placeholder="enter USD">
                        </td>
                        <td><input type="submit" id="USDSubmit" value="SellUSD"></td>                         
                    </form>
                </tr>

                <tr>
                    <form name="sellEURForm" method="POST" action="../e-counter/SellOperations/sellOperationEUR.php">

                        <td id="codeSale2"></td>
                        <td id="sellPrice2"></td><input type="hidden" name="sellPriceEUR">                     
                        <td id="amountWallet2"></td>
                        <td id="walletValue2"></td>
                        <td>
                            <input type="number" min="0" max="1000000" name="sellEUR" placeholder="enter EUR">
                        </td>
                        <td><input type="submit" id="EURSubmit" value="SellEUR"></td>                         
                    </form>
                </tr>

                <tr>
                    <form name="sellCHFForm" method="POST" action="../e-counter/SellOperations/sellOperationCHF.php">

                        <td id="codeSale3"></td>
                        <td id="sellPrice3"></td><input type="hidden" name="sellPriceCHF">                     
                        <td id="amountWallet3"></td>
                        <td id="walletValue3"></td>
                        <td>
                            <input type="number" min="0" max="1000000" name="sellCHF" placeholder="enter CHF">
                        </td>
                        <td><input type="submit" id="CHFSubmit" value="SellCHF"></td>                         
                    </form>
                </tr>

                <tr>
                    <form name="sellRUBForm" method="POST" action="../e-counter/SellOperations/sellOperationRUB.php">

                        <td id="codeSale4"></td>
                        <td id="sellPrice4"></td><input type="hidden" name="sellPriceRUB">                     
                        <td id="amountWallet4"></td>
                        <td id="walletValue4"></td>
                        <td>
                            <input type="number" min="0" max="1000000" name="sellRUB" placeholder="enter RUB">
                        </td>
                        <td><input type="submit" id="RUBSubmit" value="SellRUB"></td>                         
                    </form>
                </tr>

                <tr>
                    <form name="sellCZKForm" method="POST" action="../e-counter/SellOperations/sellOperationCZK.php">

                        <td id="codeSale5"></td>
                        <td id="sellPrice5"></td><input type="hidden" name="sellPriceCZK">                     
                        <td id="amountWallet5"></td>
                        <td id="walletValue5"></td>
                        <td>
                            <input type="number" min="0" max="1000000" name="sellCZK" placeholder="enter CZK">
                        </td>
                        <td><input type="submit" id="CZKSubmit" value="SellCZK"></td>                         
                    </form>
                </tr>

                <tr>
                    <form name="sellGBPForm" method="POST" action="../e-counter/SellOperations/sellOperationGBP.php">

                        <td id="codeSale6"></td>
                        <td id="sellPrice6"></td><input type="hidden" name="sellPriceGBP">                     
                        <td id="amountWallet6"></td>
                        <td id="walletValue6"></td>
                        <td>
                            <input type="number" min="0" max="1000000" name="sellGBP" placeholder="enter GBP">
                        </td>
                        <td><input type="submit" id="GBPSubmit" value="SellGBP"></td>                         
                    </form>
                </tr>

            </table>

        </div>
        <!--ENDOF SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING SELLING -->


        <div style="clear:both"></div>	<!-- clearing atribute float:left -->

        <div class="blank_rectangle">
        </div>

        <div style="clear:both"></div>  <!-- clearing atribute float:left -->

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
	
    <div id="logdiv">
        <form id="logForm" type="hidden" action="index.php" method="post">
        <input type="hidden" type="text" name="logTime">
        <input name="currencyRow1">
        <input name="currencyRow2">
        <input name="currencyRow3">
        <input name="currencyRow4">
        <input name="currencyRow5">
        <input name="currencyRow6">
        <input type="hidden" type="submit" value="submit">
    </form>
    <?php
        // echo $_POST['logTime'];
        // $file = "log.txt";
        // $content = $_POST['logTime'];
        // file_put_contents($file, $content);
        //date("Y-m-d").

        $file=fopen("log.txt","a+") or exit("Unable to open file!");

        if ($_POST["logTime"] <> "")
        {
            fwrite($file,$_POST["logTime"].",");
            for($i=0;$i<6;$i++)
            {
                if($i+1 == 6)
                {
                    fwrite($file,$_POST["currencyRow".($i+1).""]);
                }
                else
                {
                    fwrite($file,$_POST["currencyRow".($i+1).""].",");
                }



            }
                fwrite($file, "\n");
            
            // fwrite($file,$_POST["currencyRow1"].",");
            // fwrite($file,$_POST["currencyRow1"].",");
            // fwrite($file,$_POST["currencyRow1"].",");
            // fwrite($file,$_POST["currencyRow1"].",");
            // fwrite($file,$_POST["currencyRow1"]."\n");
        }

        fclose($file);
    ?>
    </div>

</body>
</html>
