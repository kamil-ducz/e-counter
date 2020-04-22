<?php
    $file=fopen("log.txt","a+") or exit("Unable to open file!");

    fwrite($file,$_POST["logTime"].",");
    fwrite($file,$_POST["purchasePrice1"].",");
    fwrite($file,$_POST["purchasePrice2"].",");
    fwrite($file,$_POST["purchasePrice3"].",");
    fwrite($file,$_POST["purchasePrice4"].",");
    fwrite($file,$_POST["purchasePrice5"].",");
    fwrite($file,$_POST["purchasePrice6"].",");

    fwrite($file,$_POST["sellPrice1"].",");
    fwrite($file,$_POST["sellPrice2"].",");
    fwrite($file,$_POST["sellPrice3"].",");
    fwrite($file,$_POST["sellPrice4"].",");
    fwrite($file,$_POST["sellPrice5"].",");
    fwrite($file,$_POST["sellPrice6"]."\n");

    fclose($file);
?>