<?php 

    //MGSM.PL
    require_once("lib/simple_html_dom.php");
    require_once("phoneMiner.php");
    
    $phonesNum = 1; //Max 13 phones on a page
    $pageNum = 2;   //Min 2 
    
    $site = "https://www.mediaexpert.pl";
    $prefix = "/smartfony-i-zegarki/smartfony?limit=" . $phonesNum . "&page=";


    $miner = new PhoneMiner();

    $jsonArr = array();

    for($j = 1 ; $j < $pageNum; $j++){

        $html = file_get_html($site . $prefix . $j);

        for($i = 0 ; $i < $phonesNum ; $i++){
            
            $phoneDom = $miner -> getPhoneDOM($html, $i);
    
            $link = $miner -> getPhoneLink($phoneDom);
    
            $newHtml = file_get_html($link);

            $phoneInfo = array();

            $phoneInfo = $miner -> getFullInfo($newHtml);               

            array_push($jsonArr, $phoneInfo);
            unset($phoneInfo);
        }
    }

    echo json_encode($jsonArr);

?>