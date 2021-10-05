<?php 

    //MGSM.PL
    require_once("lib/simple_html_dom.php");
    require_once("phoneMiner.php");

    $site = "https://www.mediaexpert.pl";
    $prefix = "/smartfony-i-zegarki/smartfony?limit=5&page=";

    $miner = new PhoneMiner();

    $jsonArr = array();

    for($j = 1 ; $j < 2; $j++){

        $html = file_get_html($site . $prefix . $j);

        for($i = 0 ; $i < 5 ; $i++){
            
            $phoneDom = $miner -> getPhoneDOM($html, $i);
            $phoneDir = $miner -> getHref($phoneDom);
    
            $link = $site . $phoneDir;
    
            $newHtml = file_get_html($link);

            $phoneInfo = array();

            $phoneInfo = $miner -> getFullInfo($newHtml);               
            //echo "<br><br><br>";

            array_push($jsonArr, $phoneInfo);
            unset($phoneInfo);
        }
    }

    echo json_encode($jsonArr);

?>