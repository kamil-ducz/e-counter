function checkPassword(input) {
  if (input.value != document.getElementById('inputPassword').value) {
      input.setCustomValidity('Hasła muszą się zgadzać!');
  } else {
      input.setCustomValidity('');
  }
}

function unhidePassword() {
  var x = document.getElementById("inputPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

setInterval(function(){ getAndCalcData(); }, 30000);

function getAndCalcData() 
{
  $.ajax
  ({                         //https://www.w3schools.com/jquery/ajax_ajax.asp                               
  url: "api.php",                  //read from api.php
  method: "POST",     
  dataType: 'json',
  success: function(db_data)          // json_data argument contains row from databsase
  {
   $.getJSON("server_content.php")
      .done
      (function(json_data) 
      {

          function logfile()
            {
              $.ajax({                             
                url: "logfile.php",
                method: "POST",
                data:"logTime=" + json_data.publicationDate + "&purchasePrice1=" + json_data.items[0].purchasePrice + "&purchasePrice2=" + json_data.items[1].purchasePrice + "&purchasePrice3=" + json_data.items[2].purchasePrice + "&purchasePrice4=" + json_data.items[3].purchasePrice + "&purchasePrice5=" + json_data.items[4].purchasePrice + "&purchasePrice6=" + json_data.items[5].purchasePrice + "&sellPrice1=" + json_data.items[0].sellPrice + "&sellPrice2=" + json_data.items[1].sellPrice + "&sellPrice3=" + json_data.items[2].sellPrice + "&sellPrice4=" + json_data.items[3].sellPrice + "&sellPrice5=" + json_data.items[4].sellPrice + "&sellPrice6=" + json_data.items[5].sellPrice           ,
                success: function(data){}	  
                });
            }
          logfile();

          function digCurrencies()//yesterday currency state
            {
              $.ajax({
                url: "digCurrencies.php",
                method: "POST",
                dataType: "json",
                success: function(currency_data)
                {
                  console.log("yesterday avg courses array(buy and then sell): "+currency_data)
                  console.log("yesterday USD average course: "+currency_data[0]);
                  console.log("currency_data.length: "+currency_data.length);
                  for (i = 0; i < currency_data.length/2; i++) //buy avg courses
                  {
                    console.log("currency_data["+i+"]: "+currency_data[i]+" json_data.items["+i+"].purchasePrice: "+json_data.items[i].purchasePrice);
                    if(currency_data[i] < json_data.items[i].purchasePrice)
                    {
                      $(("#suggestionBuy")+(i+1)).html('<span class="badge badge-pill badge-danger">Nie kupować</span>');
                    }
                    else if(currency_data[i] == json_data.items[i].purchasePrice)
                    {
                      $(("#suggestionBuy")+(i+1)).html('<span class="badge badge-pill badge-info">Bez zmian</span>');
                    }
                    else
                    {
                      $(("#suggestionBuy")+(i+1)).html('<span class="badge badge-pill badge-success">Kupować</span>');
                    }
                  }

                  for (i = currency_data.length/2; i < currency_data.length; i++) //sell avg courses
                  {
                    console.log("currency_data["+i+"]: "+currency_data[i]+" json_data.items["+(i-6)+"].sellPrice: "+json_data.items[i-6].sellPrice);
                    if(currency_data[i] < json_data.items[i-6].sellPrice)
                    {
                      $(("#suggestionSell")+(i-5)).html('<span class="badge badge-pill badge-success">Sprzedawać</span>');
                    }
                    else if(currency_data[i] == json_data.items[i-6].sellPrice)
                    {
                      $(("#suggestionSell")+(i-5)).html('<span class="badge badge-pill badge-info">Bez zmian</span>');
                    }
                    else
                    {
                      $(("#suggestionSell")+(i-5)).html('<span class="badge badge-pill badge-danger">Nie sprzedawać</span>');
                    }
                  }
                }

                

              });
            }
          digCurrencies();



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
          chartUSD.options.data[0].dataPoints.push({ y: json_data.items[0].sellPrice});
          chartUSD.render();
          chartEUR.options.data[0].dataPoints.push({ y: json_data.items[1].sellPrice});
          chartEUR.render();
          chartCHF.options.data[0].dataPoints.push({ y: json_data.items[2].sellPrice});
          chartCHF.render();
          chartRUB.options.data[0].dataPoints.push({ y: json_data.items[3].sellPrice});
          chartRUB.render();
          chartCZK.options.data[0].dataPoints.push({ y: json_data.items[4].sellPrice});
          chartCZK.render();
          chartGBP.options.data[0].dataPoints.push({ y: json_data.items[5].sellPrice});
          chartGBP.render();
          //CHART ENDING
          
        }
        )
        
        .fail
        (function() 
        {
            alert( "Serwer niedostępny. Sprawdź połączenie sieciowe. Zapory sieciowe mogą blokować serwer firmy Future Processing. Plik server_content.php może być nieprawidłowy, wówczas skontakuj się z administratorem aplikacji.");
        }
        );
  
  } 
  });
};

getAndCalcData();