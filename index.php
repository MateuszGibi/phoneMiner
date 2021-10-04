<?php 

    require_once("lib/simple_html_dom.php");
    require_once("phoneMiner.php");

    $site = "https://www.mediaexpert.pl";
    $prefix = "/smartfony-i-zegarki/smartfony?limit=13&page=";

    $miner = new PhoneMiner();

    for($j = 1 ; $j < 2; $j++){
        $html = file_get_html($site . $prefix . $j);
        for($i = 0 ; $i < 13 ; $i++){
        
            try{
                $phoneDom = $miner -> getPhoneDOM($html, $i);
        
                @$miner -> printInfo($phoneDom);
        
                echo "<br><br><br>";
            }
            catch(Error $error){
                echo "Cannot read phone's info";
                echo "<br><br><br>";
            }
        }
    }

?>