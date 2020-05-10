function checkPassword(input) {
  if (input.value != document.getElementById('inputPassword').value) {
      input.setCustomValidity('Hasła muszą się zgadzać!');
  } else {
      input.setCustomValidity('');
  }
}

setInterval(function(){ getAndCalcData(); }, 30000);

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

//         n data variable



// Now you have only one variable named logtime



// If you want to send several variables here the syntax



// data:"logtime="+value1+"&variable2="+value2+"&variable3"+value3;



// example pf sending three variables inside Post array in ajax

              function logfile(){
                $.ajax({                             
                  url: 'logfile.php',
                  method: "POST",
                  data:"logTime=" + json_data.publicationDate + "&purchasePrice1=" + json_data.items[0].purchasePrice + "&purchasePrice2=" + json_data.items[1].purchasePrice + "&purchasePrice3=" + json_data.items[2].purchasePrice + "&purchasePrice4=" + json_data.items[3].purchasePrice + "&purchasePrice5=" + json_data.items[4].purchasePrice + "&purchasePrice6=" + json_data.items[5].purchasePrice + "&sellPrice1=" + json_data.items[0].sellPrice + "&sellPrice2=" + json_data.items[1].sellPrice + "&sellPrice3=" + json_data.items[2].sellPrice + "&sellPrice4=" + json_data.items[3].sellPrice + "&sellPrice5=" + json_data.items[4].sellPrice + "&sellPrice6=" + json_data.items[5].sellPrice           ,
                  success: function(data){}	  
                  });

                // $.ajax({                                                      
                //   url: 'logfile.php',                
                //   method: "POST",
                //   data:"currencyRow1=" + json_data.items[0].sellPrice,
                //   success: function(result){
                  
                //   }	  
                //   });

                //   $.ajax({                                                     
                //     url: 'logfile.php',                  
                //     method: "POST",
                //     data:"currencyRow2=" + json_data.items[1].sellPrice,
                //     success: function(result){
                    
                //     }	  
                //     });

                //     $.ajax({                                                    
                //       url: 'logfile.php',              
                //       method: "POST",
                //       data:"currencyRow3=" + json_data.items[2].sellPrice,
                //       success: function(result){
                      
                //       }	  
                //       });
                //     $.ajax({                                                    
                //       url: 'logfile.php',              
                //       method: "POST",
                //       data:"currencyRow4=" + json_data.items[3].sellPrice,
                //       success: function(result){
                      
                //       }	  
                //       });
                //     $.ajax({                                                    
                //       url: 'logfile.php',              
                //       method: "POST",
                //       data:"currencyRow5=" + json_data.items[4].sellPrice,
                //       success: function(result){
                      
                //       }	  
                //       });
                //       $.ajax({                                                    
                //         url: 'logfile.php',              
                //         method: "POST",
                //         data:"currencyRow6=" + json_data.items[5].sellPrice,
                //         success: function(result){
                        
                //         }	  
                //         });

              }
              logfile();



              var res1 = json_data.publicationDate.split("T");
              var res2 = res1[1].split(".");	
              var result = res1[0] + " " + res2[0];		
              $("#lastUpdate").text("Ostatnia aktualizacja walut: " +  result + " - (Centralny Czas Europejski)");
              for (i = 0; i < json_data.items.length; i++)
              {
                  if(i == 3 || i == 4)
                  {
                    json_data.items[i].purchasePrice /= 100;
                  }
                  $("#code" + (i + 1)).text(json_data.items[i].code );
                  $("#unit" + (i + 1)).text(json_data.items[i].unit );
                  $("#sellPrice" + (i + 1)).text(parseFloat(json_data.items[i].purchasePrice).toFixed(2));
              }
              for (i = 0; i < json_data.items.length; i++)
              {
                if(i == 3 || i==4)
                {
                  json_data.items[i].sellPrice /= 100;
                }
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
              
              for(i = 0; i < json_data.items.length; i++)
              {
                  $("#amountWallet" + (i + 1)).text(db_data[i+6]);
                  $("#walletValue" + (i + 1)).text(parseFloat(db_data[i+6] * json_data.items[i].sellPrice).toFixed(2));
              }

              var totalPLN = 0;
              var currentCurrencyValue = [];
              for(i = 0; i < json_data.items.length; i++)
              {                
                  currentCurrencyValue[i] = db_data[i+6] * json_data.items[i].sellPrice;
                  totalPLN += currentCurrencyValue[i];
              }
              $walletPLN = parseFloat(db_data[12]);
              totalPLN = totalPLN + $walletPLN;
              $("#totalPLN").text(parseFloat(totalPLN).toFixed(2));

              //CHART STARTING
              chart.options.data[0].dataPoints.push({ y: 25 - Math.random() * 10});
              chart.render();
              //CHART ENDING
              
          })
        
        .fail(function() {
            alert( "Serwer niedostępny. Sprawdź połączenie sieciowe. Zapory sieciowe mogą blokować serwer firmy Future Processing. Plik server_content.php może być nieprawidłowy, wówczas skontakuj się z administratorem aplikacji.");
        });
  
  } 
  });
};

getAndCalcData();