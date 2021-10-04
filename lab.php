<?php

use function PHPSTORM_META\type;

    require_once("lib/simple_html_dom.php");
    require_once("phoneMiner.php");

    //$html = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony?limit=220&page=2");
    $html = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony?limit=5&page=" . 2);
    //$html = file_get_html("Smartfony - niskie ceny i setki opinii w Media Expert.html");

    $hehehtml = file_get_html("https://www.mediaexpert.pl/smartfony-i-zegarki/smartfony/smartfon-xiaomi-redmi-10-4-128gb-carbon-gray");

    $miner = new PhoneMiner();    
    $phoneDom = $miner -> getPhoneDOM($html, 0);
    //echo $phoneDom;
    
    $phoneDir = $miner -> getHref($phoneDom);
    
    $link = "https://www.mediaexpert.pl" . $phoneDir;
    
    $newHtml = file_get_html($link);

    //echo $newHtml;

    //$test = $miner -> getSpecDOM($newHtml, 0);

    //echo $test;

    $camArr = $miner -> getFullParamInfo($newHtml);

    // $paramName = $miner -> getSpecDOM($newHtml, 5) -> children(1) -> children(0) -> plaintext;

    // echo gettype($paramName);

    // echo $paramName;

    // foreach($camArr as $info){
    //     echo $info . "<br>";
    // }

    echo json_encode($camArr);

    // foreach($camArr as $info){
    //     echo $info . "<br>";
    // }
    // $camArr = $miner -> getFullFunctionInfo($newHtml);
    // foreach($camArr as $info){
    //     echo $info . "<br>";
    // }
    // $camArr = $miner -> getFullCommunicationInfo($newHtml);
    // foreach($camArr as $info){
    //     echo $info . "<br>";
    // }
    // $camArr = $miner -> getFullMultimediaInfo($newHtml);
    // foreach($camArr as $info){
    //     echo $info . "<br>";
    // }
    // $camArr = $miner -> getFullNavInfo($newHtml);
    // foreach($camArr as $info){
    //     echo $info . "<br>";
    // }
    // $camArr = $miner -> getFullOsInfo($newHtml);
    // foreach($camArr as $info){
    //     echo $info . "<br>";
    // }



    // if($i == 8 && $paramName != "Model smartfona "){
    //     //echo $paramName;
    //     array_push($paramInfo, null);
    //     $info = $this -> getSpecDOM($phoneLink, 6) -> children($i) -> children(1) -> plaintext;
    //     array_push($paramInfo, $info);
    // }
    // elseif(( $i == 10 && $paramName != "Rodzaj ") ){
    //     array_push($paramInfo, null);
    //     $info = $this -> getSpecDOM($phoneLink, 6) -> children($i) -> children(1) -> plaintext;
    //     array_push($paramInfo, $info);
    // }
    // else{
    //     $info = $this -> getSpecDOM($phoneLink, 6) -> children($i) -> children(1) -> plaintext;
    //     array_push($paramInfo, $info);
    // }



?>