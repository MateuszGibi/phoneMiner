<?php
    require_once("lib/simple_html_dom.php");
    require_once("phoneMiner.php");

    //$gsmHtml = file_get_html("https://www.mgsm.pl/pl/");
    //$html = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony?limit=220&page=2");
    $html = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony?limit=5&page=" . 2);
    //$html = file_get_html("Smartfony - niskie ceny i setki opinii w Media Expert.html");

     $hehehtml = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony/smartfon-xiaomi-redmi-10-4-128gb-carbon-gray");

    $miner = new PhoneMiner();

    $camArr = $miner -> getImages($hehehtml);


    //echo json_encode($camArr);
?>