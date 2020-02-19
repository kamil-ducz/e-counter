setTimeout(function(){ $("#hiddenForm").submit();clearTimeout() }, 3000);

refreshData();
setInterval("refreshData()", 10000);

function setValues()
{
    	document.hiddenForm.valueUSD.value = data.items[0].sellPrice;
		document.hiddenForm.valueEUR.value = data.items[1].sellPrice;
		document.hiddenForm.valueCHF.value = data.items[2].sellPrice;
		document.hiddenForm.valueRUB.value = data.items[3].sellPrice;
		document.hiddenForm.valueCZK.value = data.items[4].sellPrice;
		document.hiddenForm.valueGBP.value = data.items[5].sellPrice;
		
		document.hiddenForm.valueUSD2.value = data.items[0].purchasePrice;
		document.hiddenForm.valueEUR2.value = data.items[1].purchasePrice;
		document.hiddenForm.valueCHF2.value = data.items[2].purchasePrice;
		document.hiddenForm.valueRUB2.value = data.items[3].purchasePrice;
		document.hiddenForm.valueCZK2.value = data.items[4].purchasePrice;
		document.hiddenForm.valueGBP2.value = data.items[5].purchasePrice;
}
	
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
                
        document.hiddenForm.valueUSD.value = data.items[0].sellPrice;
		document.hiddenForm.valueEUR.value = data.items[1].sellPrice;
		document.hiddenForm.valueCHF.value = data.items[2].sellPrice;
		document.hiddenForm.valueRUB.value = data.items[3].sellPrice;
		document.hiddenForm.valueCZK.value = data.items[4].sellPrice;
		document.hiddenForm.valueGBP.value = data.items[5].sellPrice;
		
		document.hiddenForm.valueUSD2.value = data.items[0].purchasePrice;
		document.hiddenForm.valueEUR2.value = data.items[1].purchasePrice;
		document.hiddenForm.valueCHF2.value = data.items[2].purchasePrice;
		document.hiddenForm.valueRUB2.value = data.items[3].purchasePrice;
		document.hiddenForm.valueCZK2.value = data.items[4].purchasePrice;
		document.hiddenForm.valueGBP2.value = data.items[5].purchasePrice;

		//document.hiddenForm.submit();

		//alert("got new values form server!")

		
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
