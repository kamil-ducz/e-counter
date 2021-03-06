<?php
    session_start();
    if(!isset($_SESSION['login'])) //not logged
    {
    header('Location: login.php');
    }

    if(isset($_SESSION['login'])) $logged = $_SESSION['login']; //logged
    // if(isset($_SESSION['error']))
    // {
    //     unset($_SESSION['error']);
    // }
    require_once('connect.php');
    $link = mysqli_connect($host, $db_user, $db_password);
    mysqli_select_db($link, "ecounter_usersdatabase");
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta Content-Type = "application/json" charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Internetowy System Wymiany Walut</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="css/fontello.css" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'>
    <!-- <link rel="stylesheet" href="css/style.css" type="text/css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
	<script language="javascript" type="text/javascript" src="script.js?newversion"></script>
</head>
<body>
    <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="btn btn-primary" href="index.php">Internetowy System Wymiany Walut</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor03">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">O projekcie <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">O autorze</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <span> Witaj <?php echo  $_SESSION['login']?> </span>
                    <a href="userSettings.php" class="icon-cog"></a>
                    <a href="logout.php" class="icon-power"></a>
                </div>
            </nav>

            <blockquote class="blockquote text-center">
                <p class="mb-0">
                    Witaj drogi użytkowniku! <br />Dziękujemy za zalogowanie do Internetowego Systemu Wymiany Walut. Używaj swojego portfela, kupuj, sprzedawaj, planuj. Poznaj jak działa kantor, sprawdzaj wykresy. Możesz też skorzystać z podpowiedzi, co warto a co nie warto kupić lub sprzedać. Miłego użytkowania.
                </p>            
            </blockquote>

    <button type="button" class="btn btn-info">Kantor</button>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">Waluta</th>
        <th scope="col">Cena kupna</th>
        <th scope="col">Ile kupić?</th>
        <th scope="col">Kupuj</th>
        <th scope="col">Podpowiedź</th>
        </tr>
    </thead>
    <?php
    if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        
    ?>
    <tbody>
        <tr>
            <form name="buyUSDForm" method="POST" action="BuyOperations/buyOperationUSD.php">
                <td id="code1"></td>
                <td id="purchasePrice1"></td><input type="hidden" name="buyPriceUSD">                     
                <td>
                    <input type="number" min="0" max="1000" name="buyUSD" placeholder="USD" class="form-control">
                </td>
                <td><button type="submit" id="USDSubmit" value="BuyUSD" class="btn btn-primary">Kup wprowadzoną ilość</button></td>
                <?php

        
    ?>        
                <td id="suggestionBuy1"></td>                 
            </form>
        </tr>
        <tr>
            <form name="buyEURForm" method="POST" action="BuyOperations/buyOperationEUR.php">

                <td id="code2"></td>
                <td id="purchasePrice2"></td><input type="hidden" name="buyPriceEUR">                     
                <td>
                    <input type="number" min="0" max="1000" name="buyEUR" placeholder="EUR"  class="form-control">
                </td>
                <td><button type="submit" id="EURSubmit" value="BuyEUR" class="btn btn-primary">Kup wprowadzoną ilość</button></td>
                <td id="suggestionBuy2"></td>                         
            </form>
        </tr>
        <tr>
            <form name="buyCHFForm" method="POST" action="BuyOperations/buyOperationCHF.php">

                <td id="code3"></td>
                <td id="purchasePrice3"></td><input type="hidden" name="buyPriceCHF">                     
                <td>
                    <input type="number" min="0" max="1000" name="buyCHF" placeholder="CHF" class="form-control">
                </td>
                <td><button type="submit" id="CHFSubmit" value="BuyCHF" class="btn btn-primary">Kup wprowadzoną ilość</button></td>
                <td id="suggestionBuy3"></td>                         
            </form>
        </tr>
        <tr>
            <form name="buyRUBForm" method="POST" action="BuyOperations/buyOperationRUB.php">

                <td id="code4"></td>
                <td id="purchasePrice4"></td><input type="hidden" name="buyPriceRUB">                     
                <td>
                    <input type="number" min="0" max="1000" name="buyRUB" placeholder="RUB" class="form-control">
                </td>
                <td><button type="submit" id="RUBSubmit" value="BuyRUB" class="btn btn-primary">Kup wprowadzoną ilość</button></td>
                <td id="suggestionBuy4"></td>                         
            </form>
        </tr>
        <tr>
            <form name="buyCZKForm" method="POST" action="BuyOperations/buyOperationCZK.php">

                <td id="code5"></td>
                <td id="purchasePrice5"></td><input type="hidden" name="buyPriceCZK">                     
                <td>
                    <input type="number" min="0" max="1000" name="buyCZK" placeholder="CZK" class="form-control">
                </td>
                <td><button type="submit" id="CZKSubmit" value="BuyCZK" class="btn btn-primary">Kup wprowadzoną ilość</button></td>
                <td id="suggestionBuy5"></td>                        
            </form>
        </tr>
        <tr>
            <form name="buyGBPForm" method="POST" action="BuyOperations/buyOperationGBP.php">

                <td id="code6"></td>
                <td id="purchasePrice6"></td><input type="hidden" name="buyPriceGBP">                     
                <td>
                    <input type="number" min="0" max="1000" name="buyGBP" placeholder="GBP" class="form-control">
                </td>
                <td><button type="submit" id="GBPSubmit" value="BuyGBP" class="btn btn-primary">Kup wprowadzoną ilość</button></td>
                <td id="suggestionBuy6"></td>                         
            </form>
        </tr>
    </tbody>
    </table> 
<button type="button" class="btn btn-info">Twój portfel</button>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">Waluta</th>
        <th scope="col">Cena sprzedaży</th>
        <th scope="col">Posiadana ilość</th>
        <th scope="col">Wartość waluty w PLN</th>
        <th scope="col">Ile sprzedać?</th>
        <th scope="col">Sprzedawaj</th>
        <th scope="col">Podpowiedź</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <form name="sellUSDForm" method="POST" action="SellOperations/sellOperationUSD.php">
            <td id="codeSale1"></td>
            <td id="sellPrice1"></td><input type="hidden" name="sellPriceUSD">                     
            <td id="amountWallet1"></td>
            <td id="walletValue1"></td>
            <td>
            <input type="number" min="0" max="1000" name="sellUSD" placeholder="USD" class="form-control">
            </td>
            <td><button type="submit" id="USDSubmit" value="SellUSD" class="btn btn-primary">Sprzedaj wprowadzoną ilość</button></td>
            <td id="suggestionSell1"></td>                         
            </form>
        </tr>
        <tr>
            <form name="sellEURForm" method="POST" action="SellOperations/sellOperationEUR.php">

                <td id="codeSale2"></td>
                <td id="sellPrice2"></td><input type="hidden" name="sellPriceEUR">                     
                <td id="amountWallet2"></td>
                <td id="walletValue2"></td>
                <td>
                    <input type="number" min="0" max="1000" name="sellEUR" placeholder="EUR" class="form-control">
                </td>
                <td><button type="submit" id="EURSubmit" value="SellEUR" class="btn btn-primary">Sprzedaj wprowadzoną ilość</button></td>
                <td id="suggestionSell2"></td>                           
            </form>
        </tr>

        <tr>
            <form name="sellCHFForm" method="POST" action="SellOperations/sellOperationCHF.php">

                <td id="codeSale3"></td>
                <td id="sellPrice3"></td><input type="hidden" name="sellPriceCHF">                     
                <td id="amountWallet3"></td>
                <td id="walletValue3"></td>
                <td>
                    <input type="number" min="0" max="1000" name="sellCHF" placeholder="CHF" class="form-control">
                </td>
                <td><button type="submit" id="CHFSubmit" value="SellCHF" class="btn btn-primary">Sprzedaj wprowadzoną ilość</button></td>
                <td id="suggestionSell3"></td>                           
            </form>
        </tr>

        <tr>
            <form name="sellRUBForm" method="POST" action="SellOperations/sellOperationRUB.php">

                <td id="codeSale4"></td>
                <td id="sellPrice4"></td><input type="hidden" name="sellPriceRUB">                     
                <td id="amountWallet4"></td>
                <td id="walletValue4"></td>
                <td>
                    <input type="number" min="0" max="1000" name="sellRUB" placeholder="RUB" class="form-control">
                </td>
                <td><button type="submit" id="RUBSubmit" value="SellRUB" class="btn btn-primary">Sprzedaj wprowadzoną ilość</button></td>
                <td id="suggestionSell4"></td>                           
            </form>
        </tr>

        <tr>
            <form name="sellCZKForm" method="POST" action="SellOperations/sellOperationCZK.php">

                <td id="codeSale5"></td>
                <td id="sellPrice5"></td><input type="hidden" name="sellPriceCZK">                     
                <td id="amountWallet5"></td>
                <td id="walletValue5"></td>
                <td>
                    <input type="number" min="0" max="1000" name="sellCZK" placeholder="CZK" class="form-control">
                </td>
                <td><button type="submit" id="CZKSubmit" value="SellCZK" class="btn btn-primary">Sprzedaj wprowadzoną ilość</button></td>
                <td id="suggestionSell5"></td>                           
            </form>
        </tr>

        <tr>
            <form name="sellGBPForm" method="POST" action="SellOperations/sellOperationGBP.php">

                <td id="codeSale6"></td>
                <td id="sellPrice6"></td><input type="hidden" name="sellPriceGBP">                     
                <td id="amountWallet6"></td>
                <td id="walletValue6"></td>
                <td>
                    <input type="number" min="0" max="1000" name="sellGBP" placeholder="GBP" class="form-control">
                </td>
                <td><button type="submit" id="GBPSubmit" value="SellGBP" class="btn btn-primary">Sprzedaj wprowadzoną ilość</button></td>
                <td id="suggestionSell6"></td>                           
            </form>
        </tr>
    </tbody>
    </table> 
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Twoje pieniądze w Polskich Złotych PLN</th>
            <th scope="col">Całkowita wartość walut i pieniędzy w PLN </th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-active">
            <td>
                <?php

                    $query = mysqli_query($link, "SELECT * FROM users WHERE login='$logged'");
                    $queryRow = mysqli_fetch_row($query);
                    $walletPLN = number_format($queryRow[12], 2, '.', '');
                    echo $walletPLN;
                ?>
            </td>
            <td id="totalPLN"></td>
            </tr>
            </tbody>
    </table> 


    <div style="clear:both"></div>  <!-- clearing atribute float:left -->
    <div id="chartUSDContainer" style="width:100%; height:280px"></div><br />
    <div id="chartEURContainer" style="width:100%; height:280px"></div><br />
    <div id="chartCHFContainer" style="width:100%; height:280px"></div><br />
    <div id="chartRUBContainer" style="width:100%; height:280px"></div><br />
    <div id="chartCZKContainer" style="width:100%; height:280px"></div><br />
    <div id="chartGBPContainer" style="width:100%; height:280px"></div><br />
<script>
        var chartUSD = new CanvasJS.Chart("chartUSDContainer", { 
                    title: {
                    text: "Kurs USD"
                    },
                        data: [
                        {
                            type: "spline",
                            dataPoints: [
                            ]
                        }
                        ]
                        });
        chartUSD.render();
        var chartEUR = new CanvasJS.Chart("chartEURContainer", { 
                    title: {
                    text: "Kurs EUR"
                    },
                        data: [
                        {
                            type: "spline",
                            dataPoints: [
                            ]
                        }
                        ]
                        });
        chartEUR.render();
        var chartCHF = new CanvasJS.Chart("chartCHFContainer", { 
                    title: {
                    text: "Kurs CHF"
                    },
                        data: [
                        {
                            type: "spline",
                            dataPoints: [
                            ]
                        }
                        ]
                        });
        chartCHF.render();
        var chartRUB = new CanvasJS.Chart("chartRUBContainer", { 
                    title: {
                    text: "Kurs RUB"
                    },
                        data: [
                        {
                            type: "spline",
                            dataPoints: [
                            ]
                        }
                        ]
                        });
        chartRUB.render();
        var chartCZK = new CanvasJS.Chart("chartCZKContainer", { 
                    title: {
                    text: "Kurs CZK"
                    },
                        data: [
                        {
                            type: "spline",
                            dataPoints: [
                            ]
                        }
                        ]
                        });
        chartCZK.render();
        var chartGBP = new CanvasJS.Chart("chartGBPContainer", { 
                    title: {
                    text: "Kurs GBP"
                    },
                        data: [
                        {
                            type: "spline",
                            dataPoints: [
                            ]
                        }
                        ]
                        });
        chartGBP.render();
        

    </script>








    <div style="clear:both"></div>  <!-- clearing atribute float:left -->
    <div id ="lastUpdate"> </div>

                   
                   
    
    <?php

    //SEARCH FILE FOR STRING, assign date to searchfor variable to find matching lines in log.txt

    // $file = 'log.txt';
    // $searchfor = '2020-03-24';
    // // the following line prevents the browser from parsing this as HTML.
    // header('Content-Type: text/plain');
    // // get the file contents, assuming the file to be readable (and exist)
    // $contents = file_get_contents($file);
    // // escape special characters in the query
    // $pattern = preg_quote($searchfor, '/');
    // // finalise the regular expression, matching the whole line
    // $pattern = "/^.*$pattern.*\$/m";
    // // search, and store all matching occurences in $matches
    // if(preg_match_all($pattern, $contents, $matches)){
    // echo "Found matches:\n";
    // echo implode("\n", $matches[0]);
    // }
    // else{
    // echo "No matches found";
    // }
    
    //END OF SEARCH FILE FOR STRING

    ?>





</body>
</html>