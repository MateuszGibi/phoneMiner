<?php 

    //MediaExpert
    require_once("lib/simple_html_dom.php");
    require_once("phoneMiner.php");
    
    $phonesNum = 1; //Max 13 phones on a page
    $pageNum = 2;   //Min 2 
    
    $site = "https://www.mediaexpert.pl";
    $prefix = "/smartfony-i-zegarki/smartfony?limit=" . $phonesNum . "&page=";


    $miner = new PhoneMiner();

    $jsonArr = array();

    //Loop to go through all pages
    for($j = 1 ; $j < $pageNum; $j++){

        $html = file_get_html($site . $prefix . $j);

        //Loop to go through all phones on a page
        for($i = 0 ; $i < $phonesNum ; $i++){

            //Get html of phone
            $phoneDom = $miner -> getPhoneDOM($html, $i);
            $link = $miner -> getPhoneLink($phoneDom);
            $phoneHtml = file_get_html($link);

            //Set array of informations
            $phoneInfo = array();
            $phoneInfo = $miner -> getFullInfo($phoneHtml);               

            //Add information to array
            array_push($jsonArr, $phoneInfo);
            unset($phoneInfo);
        }
    }

    //List all informations array as json
    echo json_encode($jsonArr);

?>