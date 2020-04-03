getAndCalcData();
setInterval(function(){ getAndCalcData(); }, 30000);

submitLogForm();
setInterval(function () { submitLogForm(); }, 10000);

              // plan for action:
              // fix asynchronic passing to PHP
              // PHP and read from log.txt 
              // pass to js
              // use in js to chart






function getAndCalcData() 
{
  $.ajax({                         //https://www.w3schools.com/jquery/ajax_ajax.asp                               
  url: 'api.php',                  //read from api.php
  method: "POST",     
  dataType: 'json',
  success: function(db_data)          // json_data argument contains row from databsase
  {  
   $.getJSON("server_content.php")
      .done(function(json_data) {






          //pass json_data to html for submit - TODO fix to asynchronous passing to PHP
          $('input[name=logTime]').val(json_data.publicationDate);
          for (i = 0; i < json_data.items.length; i++)
          {
            console.log("currency: " + json_data.items[i].code + " purchasePrice: " + json_data.items[i].purchasePrice + " sellPrice: " + json_data.items[i].sellPrice + "publicationDate: " + json_data.publicationDate);
            $('input[name=currencyRow' + (i+1) +'] ').val("currency: " + json_data.items[i].code + " purchasePrice: " + json_data.items[i].purchasePrice + " sellPrice: " + json_data.items[i].sellPrice);
          }











              var res1 = json_data.publicationDate.split("T");
              var res2 = res1[1].split(".");	
              var result = res1[0] + " " + res2[0];		
              $("#lastUpdate").text("Last update: " +  result + "(CET)");
              for (i = 0; i < json_data.items.length; i++)			// fill the left table - purchasePrice column
              {
                  $("#code" + (i + 1)).text(json_data.items[i].code );
                  $("#unit" + (i + 1)).text(json_data.items[i].unit );
                  $("#sellPrice" + (i + 1)).text(parseFloat(json_data.items[i].purchasePrice).toFixed(2));
              }
              for (i = 0; i < json_data.items.length; i++)		//fill the right table - sellPrice column
              {
                  $("#codeSale" + (i + 1)).text(json_data.items[i].code );
                  $("#purchasePrice" + (i + 1)).text(parseFloat(json_data.items[i].sellPrice).toFixed(2));
              }


              $('input[name=sellPriceUSD]').val(json_data.items[0].sellPrice);
              $('input[name=sellPriceEUR]').val(json_data.items[1].sellPrice);
              $('input[name=sellPriceCHF]').val(json_data.items[2].sellPrice);
              $('input[name=sellPriceRUB]').val(json_data.items[3].sellPrice);
              $('input[name=sellPriceCZK]').val(json_data.items[4].sellPrice);
              $('input[name=sellPriceGBP]').val(json_data.items[5].sellPrice);
              $('input[name=buyPriceUSD]').val(json_data.items[0].purchasePrice);
              $('input[name=buyPriceEUR]').val(json_data.items[1].purchasePrice);
              $('input[name=buyPriceCHF]').val(json_data.items[2].purchasePrice);
              $('input[name=buyPriceRUB]').val(json_data.items[3].purchasePrice);
              $('input[name=buyPriceCZK]').val(json_data.items[4].purchasePrice);
              $('input[name=buyPriceGBP]').val(json_data.items[5].purchasePrice);
              

              
              for(i = 0; i < json_data.items.length; i++)  //fill the right table - amount and value column
              {
                  $("#amountWallet" + (i + 1)).text(db_data[i+6]);
                  $("#walletValue" + (i + 1)).text(parseFloat(db_data[i+6] * json_data.items[i].sellPrice).toFixed(2));
              }

              var totalPLN = 0;
              console.log("totalPLN: " + totalPLN);
              var currentCurrencyValue = [];

              for(i = 0; i < json_data.items.length; i++)  //sum all currecies amount value with walletPLN
              {                
                  currentCurrencyValue[i] = db_data[i+6] * json_data.items[i].sellPrice;
                  console.log("currentCurrencyValue[i]: " + currentCurrencyValue[i]);
                  totalPLN += currentCurrencyValue[i];
                  console.log("totalPLN: " + totalPLN);
          
              }
              //totalPLN += data[12] * 1; //parseFloat
              console.log("totalPLN: " + totalPLN);
              $("#totalPLN").text(parseFloat(totalPLN.toFixed(2)));


              //TODO new chart needed like ajax
              //https://canvasjs.com/docs/charts/how-to/javascript-charts-from-json-data-api-and-ajax/

              function prepareChart() {

                var chart = new CanvasJS.Chart("chartContainer", { 
                  title: {
                    text: "Adding & Updating dataPoints"
                  },
                  data: [
                  {
                    type: "spline",
                    dataPoints: [
                      { y: Math.random()*10 },
                      { y:  Math.random()*10 },
                      { y: Math.random()*10 },
                      { y:  Math.random()*10 }	
                    ]
                  }
                  ]
                });
                chart.render();	
              
              $("#addDataPoint").click(function () {
              
                var length = chart.options.data[0].dataPoints.length;
                chart.options.title.text = "New DataPoint Added at the end";
                chart.options.data[0].dataPoints.push({ y: 25 - Math.random() * 10});
                chart.render();
              
                });
              
                $("#updateDataPoint").click(function () {
              
                var length = chart.options.data[0].dataPoints.length;
                chart.options.title.text = "Last DataPoint Updated";
                chart.options.data[0].dataPoints[length-1].y = 15 - Math.random() * 10;
              
                });
              
              }
              
              function drawChart() {
               chart.render();
              }
              
              prepareChart();
              drawChart();




            

              
          })
        
        //$.getJSON not ok condition:
        .fail(function() {
            alert( "Can't connect to the server. Check your internet connection or firewalls that may block Future Processing webpage; server_content.php may be broken." );
        });
  
  } 
});


};
//https://stackoverflow.com/questions/1960240/jquery-ajax-submit-form TOO
//TODO
function submitLogForm() {
        alert("Thank you for your comment!");
}

$(function() {
  // bind 'myForm' and provide a simple callback function
  $('#myForm').ajaxForm(function() {
      alert("Thank you for your comment!");
  });
});

function unhidePassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}