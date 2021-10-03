<?php

use function PHPSTORM_META\type;

require_once("lib/simple_html_dom.php");
    require_once("phoneMiner.php");

    //$html = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony?limit=220&page=2");
    $html = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony?limit=13&page=" . 1);
    //$html = file_get_html("Smartfony - niskie ceny i setki opinii w Media Expert.html");

    //$list = $html -> find("div[class='offer-box']",2);

    // $content = $list -> children(0);
    // $right = $content -> children(2);
    // $attr = $right -> children(2);
    // $attr2 = $right -> children(5);
    
    //$html -> find("div[class='offer-box']",1) -> children(0) -> children(2) -> children(2); // attr
    //$html -> find("div[class='offer-box']",1) -> children(0) -> children(5) -> children(2); // attr2
    //$html -> find("div[class='offer-box']",1) -> children(0) -> children(2) -> children(2); // attr


    // $items = $attr -> first_child();

    // //attr
    // $display = $items -> children(0) -> children(1) -> plaintext;
    // $cpu = $items -> children(1) -> children(1) -> plaintext;



    // $info = array();

    // for($i = 0 ; $i < 8; $i++){
    //     @$item = $items -> children($i) -> children(1) -> plaintext;
    //     array_push($info, $item);
    // }

    //attr2
    // $color = $attr2 -> first_child() -> first_child() -> children(1) -> plaintext;
    // $ram = $attr2 -> children(1) -> first_child() -> children(1) -> plaintext;
    //echo var_dump($list);

    //echo gettype($content);
    $hehehtml = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony/smartfon-xiaomi-redmi-10-4-128gb-carbon-gray");

    $miner = new PhoneMiner();    
    $phoneDom = $miner -> getPhoneDOM($html, 1);
    
    $phoneDir = $miner -> getHref($phoneDom);
    
    $link = "https://www.mediaexpert.pl" . $phoneDir;
    
    $newHtml = file_get_html($link);

    //$test = $miner -> getSpecDOM($newHtml, 1);
    
    echo $link;
    //echo $miner -> getSpecDOM($hehehtml, 1);
    echo $miner -> getSpecDOM($newHtml, 1);

    //echo $content -> first_child() -> children(1) -> children(1) -> first_child() -> plaintext;

    //print_r($info);

    //echo count($html -> find("div[class='offer-box']"));

    //wyświetlacz
    //procesor
    //os
    //memory
    //aparat
    //com
    //color
    //ram

?>