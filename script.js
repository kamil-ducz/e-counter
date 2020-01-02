getAndCalcData();
setInterval(function(){ getAndCalcData(); }, 30000);

function getAndCalcData() 
{
    
//-----------------------------------------------------------------------
// 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
//-----------------------------------------------------------------------
//get walletUSD from db
$.ajax({                                      
  url: 'api.php',                  //the script to call to get data from database using api.php file        
  data: "",                        //you can insert url argumnets here to pass to api.php
								   //for example "id=5&parent=6"
  dataType: 'json',                //data format      
  success: function(data)          //on recieve of reply, data has all rows from db so it's data[row][column] format
  {
	
	var id = data[0];              //get id
	var vname = data[4];           //get name
    var vwallet = data[6];
	//--------------------------------------------------------------------
	// 3) Update html content
	//--------------------------------------------------------------------
	$('#output_db').html("<b>id: </b>"+data[0][0]+"<b> name: </b>"+data[0][1] + "<b> walletUSD: </b>" + data[0][2]); //Set output element html
	//$('#output_db').html(vwallet);
	//recommend reading up on jquery selectors they are awesome 
	// http://api.jquery.com/category/selectors/

    //get purchasePrice for USD from webservice
    $.getJSON("server_content.php")		// was var jqxhr = $.getJSON but working now
    .done(function(data2) {			//if connection ok
            //get date and time from string, use split func to seperate string
            var res1 = data2.publicationDate.split("T");
            var res2 = res1[1].split(".");	
            var result = res1[0] + " " + res2[0];		
            
            $("#lastUpdate").text("Last update: " +  result + "(GMT+1)");		// write in div with id "last update" (Time:GMT)
            

            for (i = 0; i < data2.items.length; i++)			// fill the left table
            {
                $("#code" + (i + 1)).text(data2.items[i].code );
                $("#unit" + (i + 1)).text(data2.items[i].unit );
                $("#sellPrice" + (i + 1)).text(data2.items[i].purchasePrice);
                
            }

            $('input[name=sellPriceUSD]').val(data2.items[0].sellPrice);
            $('input[name=sellPriceEUR]').val(data2.items[1].sellPrice);
            $('input[name=sellPriceCHF]').val(data2.items[2].sellPrice);
            $('input[name=sellPriceRUB]').val(data2.items[3].sellPrice);
            $('input[name=sellPriceCZK]').val(data2.items[4].sellPrice);
            $('input[name=sellPriceGBP]').val(data2.items[5].sellPrice);
            $('input[name=buyPriceUSD]').val(data2.items[0].purchasePrice);
            $('input[name=buyPriceEUR]').val(data2.items[1].purchasePrice);
            $('input[name=buyPriceCHF]').val(data2.items[2].purchasePrice);
            $('input[name=buyPriceRUB]').val(data2.items[3].purchasePrice);
            $('input[name=buyPriceCZK]').val(data2.items[4].purchasePrice);
            $('input[name=buyPriceGBP]').val(data2.items[5].purchasePrice);
            
            for (i = 0; i < data2.items.length; i++)		//fill the right table - sellPrice column
            {
                $("#codeSale" + (i + 1)).text(data2.items[i].code );
                $("#purchasePrice" + (i + 1)).text(data2.items[i].sellPrice );
            }

            
            for(i = 0; i < data2.items.length; i++)  //fill the right table - amount and value column
            {
                $("#amountWallet" + (i + 1)).text(data[i+6]);
                $("#walletValue" + (i + 1)).text(parseFloat(data[i+6] * data2.items[i].sellPrice).toFixed(4));
            }

            var totalPLN = 0;
			console.log("totalPLN: " + totalPLN);
            var currentCurrencyValue = [];

            for(i = 0; i < data2.items.length; i++)  //sum all currecies amount value with walletPLN
            {                
                currentCurrencyValue[i] = data[i+6] * data2.items[i].sellPrice;
                console.log("currentCurrencyValue[i]: " + currentCurrencyValue[i]);
                totalPLN += currentCurrencyValue[i];
				console.log("totalPLN: " + totalPLN);
				
            }
			totalPLN += data[12] * 1; //parseFloat
			console.log("totalPLN: " + totalPLN);
            $("#totalPLN").text(parseFloat(totalPLN.toFixed(4)));
            
        })
        
        .fail(function() {		//if not connected
            alert( "Can't connect to the server" );
        });
  
  } 
});


};