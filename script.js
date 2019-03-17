getAndCalcData();
    
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
                $("#purchasePrice" + (i + 1)).text(data2.items[i].purchasePrice);
            }
            
            for (i = 0; i < data2.items.length; i++)		//fill the right table - sellPrice column
            {
                $("#codeSale" + (i + 1)).text(data2.items[i].code );
                $("#sellPrice" + (i + 1)).text(data2.items[i].sellPrice );
            }

            for(i = 0; i < 6; i++)  //fill the right table - amount column
            {
                $("#amountWallet" + (i + 1)).text(data[0][i+6]);
                $("#walletValue" + (i + 1)).text(data[0][i+6] * data2.items[i].sellPrice)
            }


            
            
            

            
        })
        
        .fail(function() {		//if not connected
            alert( "Can't connect to the server." );
        });
  
  } 
});

};




/*
setTimeout(function(){ $("#hiddenForm").submit();clearTimeout() }, 300000);

refreshData();
setInterval("refreshData()", 100000);

function refreshData()
{

	   $.getJSON( "proxy.php")		// was var jqxhr = $.getJSON but working now
	  .done(function(data) {			//if connection ok
		//get date and time from string, use split func to seperate string
		var res1 = data.publicationDate.split("T");
		var res2 = res1[1].split(".");	
		var result = res1[0] + " " + res2[0];		
		
		$("#lastUpdate").text("Last update: " +  result + "(GMT+1)");		// write in div with id "last update" (Time:GMT)
		
		for (i = 0; i < data.items.length; i++)			// fill the left table
		{
			$("#code" + (i + 1)).text(data.items[i].code );
			$("#unit" + (i + 1)).text(data.items[i].unit );
			$("#purchasePrice" + (i + 1)).text(data.items[i].purchasePrice);
		}
		
		for (i = 0; i < data.items.length; i++)		//fill the right table
		{
			$("#codeb" + (i + 1)).text(data.items[i].code );
			$("#sellPrice" + (i + 1)).text(data.items[i].sellPrice );
		}           

		
	  })
	  .fail(function() {		//if not connected
		alert( "Can't connect to the server." );
	  });

}

// selling
function operationsUSD()
{
    var ileUSD = prompt('How much do you want to sell?','100');
    document.sellForm.sellUSD.value = ileUSD;
    document.sellForm.submit();
    sendCurrencies();

}

function operationsEUR()
{
    var ileEUR = prompt('How much do you want to sell?','100');
    document.sellForm.sellEUR.value = ileEUR;
    document.sellForm.submit();
    document.hiddenForm.submit();
}

function operationsCHF()
{
    var ileCHF = prompt('How much do you want to sell?','100');
    document.sellForm.sellCHF.value = ileCHF;
    document.sellForm.submit();
    document.hiddenForm.submit();
}

function operationsRUB()
{
    var ileRUB = prompt('How much do you want to sell?','100');
    document.sellForm.sellRUB.value = ileRUB;
    document.sellForm.submit();
    document.hiddenForm.submit();
}

function operationsCZK()
{
    var ileCZK = prompt('How much do you want to sell?','100');
    document.sellForm.sellCZK.value = ileCZK;
    document.sellForm.submit();
    document.hiddenForm.submit();
}

function operationsGBP()
{
    var ileGBP = prompt('How much do you want to sell?','100');
    document.sellForm.sellGBP.value = ileGBP;
    document.sellForm.submit();
    document.hiddenForm.submit();

}
//2 means operations - buttons for buying
function operationsUSD2()
{
    var ileUSD2 = prompt('How much do you want to sell?','100');
    document.buyForm.buyUSD.value = ileUSD2;
    document.buyForm.submit();
    document.hiddenForm.submit();
}

function operationsEUR2()
{
    var ileEUR2 = prompt('How much do you want to buy?','100');
    document.buyForm.buyEUR.value = ileEUR2;

    document.buyForm.submit();
    document.hiddenForm.submit();
}

function operationsCHF2()
{
    var ileCHF2 = prompt('How much do you want to buy?','100');
    document.buyForm.buyCHF.value = ileCHF2;

    document.buyForm.submit();
    document.hiddenForm.submit();
}

function operationsRUB2()
{
    var ileRUB2 = prompt('How much do you want to buy?','100');
    document.buyForm.buyRUB.value = ileRUB2;

    document.buyForm.submit();
    document.hiddenForm.submit();
}

function operationsCZK2()
{
    var ileCZK2 = prompt('How much do you want to buy?','100');
    document.buyForm.buyCZK.value = ileCZK2;

    document.buyForm.submit();
    document.hiddenForm.submit();
}
function operationsGBP2()
{
    var ileGBP2 = prompt('How much do you want to buy?','100');
    document.buyForm.buyGBP.value = ileGBP2;

    document.buyForm.submit();
    document.hiddenForm.submit();
}
*/