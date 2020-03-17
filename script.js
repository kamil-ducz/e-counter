getAndCalcData();
setInterval(function(){ getAndCalcData(); }, 30000);




function submitLogForm() {
  $('#logForm').submit();
}

submitLogForm();
setInterval(function () { submitLogForm(); }, 20000);





function unhidePassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


function getAndCalcData() 
{

  $.ajax({                         //https://www.w3schools.com/jquery/ajax_ajax.asp                               
  url: 'api.php',                  //read from api.php     
  dataType: 'json',
  success: function(data)          // data argument contains row from databsase
  {



    //$.getJSON inside $.ajax method   
   $.getJSON("server_content.php")  //

    //$.getJSON ok condition:
    .done(function(data2) {

      //var myjson = data2;
      // for (i = 0; i < data2.items.length; i++)
      //   {
      //     console.log("mcurrency: " + data2.items[i].code + " purchasePrice: " + data2.items[i].purchasePrice + " sellPrice: " + data2.items[i].sellPrice + "publicationDate: " + data2.publicationDate);
      //   }

        // //var name1 = $("#txtSource").val();
        // var name1 = "super log 555";
        // $.ajax({
        //   type: "POST",
        //   url: 'index.php',
        //   data: "villeDepart=" + name1,
        //   cache: false,
        //   success: function(result) {
        //     alert("yay, now write to #logger");
        //     $("#logger").html(result);
        //   },
        //   error: function() {
        //     alert("error");
        //   }
        // });
        $('input[name=logTime]').val(data2.publicationDate);






      

            var res1 = data2.publicationDate.split("T");
            var res2 = res1[1].split(".");	
            var result = res1[0] + " " + res2[0];		
            $("#lastUpdate").text("Last update: " +  result + "(CET)");
            for (i = 0; i < data2.items.length; i++)			// fill the left table - purchasePrice column
            {
                $("#code" + (i + 1)).text(data2.items[i].code );
                $("#unit" + (i + 1)).text(data2.items[i].unit );
                $("#sellPrice" + (i + 1)).text(data2.items[i].purchasePrice);
            }
            for (i = 0; i < data2.items.length; i++)		//fill the right table - sellPrice column
            {
                $("#codeSale" + (i + 1)).text(data2.items[i].code );
                $("#purchasePrice" + (i + 1)).text(data2.items[i].sellPrice );
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
        
        //$.getJSON not ok condition:
        .fail(function() {
            alert( "Can't connect to the server. Check your internet connection or firewalls that may block Future Processing webpage; server_content.php may be broken." );
        });
  
  } 
});


};