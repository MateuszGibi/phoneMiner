<?php 

    require_once("lib/simple_html_dom.php");

    class PhoneMiner{

        public function getPhoneDOM($html, $index)
        {
            return $html -> find("div[class='offer-box']", $index) -> children(0);
        }

        public function getSpecDOM($phoneHtml, $index)
        {
            return $phoneHtml -> find("div[class='specification']", 0) -> children(1) -> first_child() -> children($index);
        }

        // public function getName($phoneDOM)
        // {   
        //     return $phoneDOM -> first_child() -> children(1) -> children(1) -> first_child() -> plaintext;
        // }

        public function getName($phoneLink){
            $name = $phoneLink -> find("h1[class='name is-title']" ,0) -> plaintext;
            //$name = str_replace(" ", "", $name);

            //$name = str_ireplace("&quot;", "", $name);

            $name = htmlspecialchars_decode($name);

            return $name;
        }

        public function getDisplay($phoneDOM)
        {
            return $phoneDOM -> children(2) -> children(2) -> first_child() -> children(0) -> children(1) -> plaintext;
        }

        public function getCpu($phoneDOM)
        {
            return $phoneDOM -> children(2) -> children(2) -> first_child() -> children(1) -> children(1) -> plaintext;
        }

        public function getOs($phoneDOM)
        {
            return $phoneDOM -> children(2) -> children(2) -> first_child() -> children(2) -> children(1) -> plaintext;
        }

        public function getRam($phoneDOM)
        {
            return $phoneDOM -> children(2) -> children(2) -> first_child() -> children(3) -> children(1) -> plaintext;
        }

        public function getMemory($phoneDOM)
        {
            return $phoneDOM -> children(2) -> children(2) -> first_child() -> children(4) -> children(1) -> plaintext;
        }

        public function getCamera($phoneDOM)
        {
            return $phoneDOM -> children(2) -> children(2) -> first_child() -> children(5) -> children(1) -> plaintext;
        }

        public function getCommunication($phoneDOM)
        {
            return $phoneDOM -> children(2) -> children(2) -> first_child() -> children(6) -> children(1) -> plaintext;
        }

        public function getBattery($phoneDOM)
        {
            return $phoneDOM -> children(2) -> children(2) -> first_child() -> children(7) -> children(1) -> plaintext;
        }

        
        public function getBasicInfo($phoneDOM)
        {
            //
        }

        public function getFullCameraInfo($phoneLink)
        {
            $camInfo = array();

            for($i = 1 ; $i < 8 ; $i++){
                $info = $this -> getSpecDOM($phoneLink, 0) -> children($i) -> children(1) -> plaintext;
                array_push($camInfo, $info);
                //echo $info . "<br>";
            }

            $finalInfoArr = array(
                "is_back_cam" => $camInfo[0],
                "is_front_cam" => $camInfo[1],
                "is_led_lamp" => $camInfo[2],
                "back_cam_parameters" => $camInfo[3],
                "front_cam_parameters" => $camInfo[4],
                "cam_functions" => $camInfo[5],
                "cam_resolution" => $camInfo[6]

            );

            return $finalInfoArr;
        }

        public function getFullFunctionInfo($phoneLink)
        {
            $funcInfo = array();

            for($i = 1 ; $i < 8 ; $i++){
                $info = $this -> getSpecDOM($phoneLink, 1) -> children($i) -> children(1) -> plaintext;
                array_push($funcInfo, $info);
            }

            $finalInfoArr = array(
                "alarm" => $funcInfo[0],
                "recorder" => $funcInfo[1],
                "calendar" => $funcInfo[2],
                "calculator" => $funcInfo[3],
                "heands_free_mode" => $funcInfo[4],
                "vibrations" => $funcInfo[5],
                "additional" => $funcInfo[6]

            );

            return $finalInfoArr;
        }

        public function getFullCommunicationInfo($phoneLink)
        {
            $commuInfo = array();

            for($i = 1 ; $i < 15 ; $i++){
                $info = $this -> getSpecDOM($phoneLink, 2) -> children($i) -> children(1) -> plaintext;
                array_push($commuInfo, $info);
            }

            $finalInfoArr = array(
                "gprs" => $commuInfo[0], 
                "hsupa" => $commuInfo[1],
                "wifi_stand" => $commuInfo[2],
                "bluetooth" => $commuInfo[3],
                "hspa+" => $commuInfo[4],
                "mms" => $commuInfo[5],
                "email" => $commuInfo[6],
                "wifi" => $commuInfo[7],
                "lte" => $commuInfo[8],
                "sms" => $commuInfo[9],
                "edge" => $commuInfo[10],
                "hsdpa" => $commuInfo[11],
                "bluetooth_stand" => $commuInfo[12],
                "5g" => $commuInfo[13]
            );

            return $finalInfoArr;
        }

        public function getFullMultimediaInfo($phoneLink)
        {
            $multiInfo = array();

            for($i = 1 ; $i < 4 ; $i++){
                $info = $this -> getSpecDOM($phoneLink, 3) -> children($i) -> children(1) -> plaintext;
                array_push($multiInfo, $info);
            }

            $finalInfoArr = array(
                "gprs" => $multiInfo[0],
                "hsupa" => $multiInfo[1],
                "wifi_stand" => $multiInfo[2]
            );

            return $finalInfoArr;
        }

        public function getFullNavInfo($phoneLink)
        {
            $navInfo = array();

            for($i = 1 ; $i < 3 ; $i++){
                $info = $this -> getSpecDOM($phoneLink, 4) -> children($i) -> children(1) -> plaintext;
                array_push($navInfo, $info);
            }

            $finalInfoArr = array(
                "gps" => $navInfo[0],
                "nav_system" => $navInfo[1]
            );

            return $finalInfoArr;
        }

        
        public function getFullOSInfo($phoneLink)
        {
            $osInfo = array();

            for($i = 1 ; $i < 3 ; $i++){
                $info = $this -> getSpecDOM($phoneLink, 5) -> children($i) -> children(1) -> plaintext;
                array_push($osInfo, $info);
            }

            $finalInfoArr = array(
                "gps" => $osInfo[0],
                "nav_system" => $osInfo[1]
            );

            return $finalInfoArr;
        }
        
        public function getFullParamInfo($phoneLink)
        {
            //hehe
            $finalInfoArr = array();

            for($i = 1 ; $i < 11 ; $i++){
                $paramName = $this -> getSpecDOM($phoneLink, 6) -> children($i) -> children(0) -> plaintext;
                $paramValue = $this -> getSpecDOM($phoneLink, 6) -> children($i) -> children(1) -> plaintext;

                switch($paramName){
                    case "Kolor obudowy ":
                        //array_push($finalInfoArr, "color", $paramValue);
                        $finalInfoArr["color"] = $paramValue;
                        break;
                    case "Słuchawki w zestawie ":
                        $finalInfoArr["ph_included"] = $paramValue;
                        break;
                    case "Ładowarka w zestawie ":
                        $finalInfoArr["charger_included"] = $paramValue;
                        break;
                    case "Etui w zestawie ":
                        $finalInfoArr["etui_included"] = $paramValue;
                        break;
                    case "Pozostałe wyposażenie ":
                        $finalInfoArr["stuff"] = $paramValue;
                        break;
                    case "Załączona dokumentacja ":
                        $finalInfoArr["docs_included"] = $paramValue;
                        break;
                    case "Seria smartfona ":
                        $finalInfoArr["phone_series"] = $paramValue;
                        break;
                    case "Gwarancja ":
                        $finalInfoArr["guarantee"] = $paramValue;
                        break;
                }
            }

            return $finalInfoArr;
        }

        public function getFullTechInfo($phoneLink)
        {
            $finalInfoArr = array();

            for($i = 0 ; $i < count($this -> getSpecDOM($phoneLink, 7) -> find("tr[class='attribute']")) ; $i++){
                $techName = $this -> getSpecDOM($phoneLink, 7) -> children($i + 1) -> children(0) -> plaintext;
                $techValue = $this -> getSpecDOM($phoneLink, 7) -> children($i + 1) -> children(1) -> plaintext;

                $techName = str_replace(" ", "", $techName);
                $techValue = str_replace(" ", "", $techValue);

                $finalInfoArr[$techName] = $techValue;

                //echo $techName . ": " . $techValue;
            }

            return $finalInfoArr;
            
        }

        public function getFullDisplayInfo($phoneLink)
        {
            $finalInfoArr = array();

            for($i = 0 ; $i < count($this -> getSpecDOM($phoneLink, 8) -> find("tr[class='attribute']")) ; $i++){
                $infoName = $this -> getSpecDOM($phoneLink, 8) -> children($i + 1) -> children(0) -> plaintext;
                $infoValue = $this -> getSpecDOM($phoneLink, 8) -> children($i + 1) -> children(1) -> plaintext;

                $infoName = str_replace(" ", "", $infoName);
                $infoValue = str_replace(" ", "", $infoValue);

                $finalInfoArr[$infoName] = $infoValue;

                //echo $infoName . ": " . $infoValue;
            }

            return $finalInfoArr;
        }

        public function getFullPowerSuppInfo($phoneLink)
        {
            $finalInfoArr = array();

            for($i = 0 ; $i < count($this -> getSpecDOM($phoneLink, 9) -> find("tr[class='attribute']")) ; $i++){
                $infoName = $this -> getSpecDOM($phoneLink, 9) -> children($i + 1) -> children(0) -> plaintext;
                $infoValue = $this -> getSpecDOM($phoneLink, 9) -> children($i + 1) -> children(1) -> plaintext;

                $infoName = str_replace(" ", "", $infoName);
                $infoValue = str_replace(" ", "", $infoValue);

                $finalInfoArr[$infoName] = $infoValue;

                //echo $infoName . ": " . $infoValue;
            }

            return $finalInfoArr;
        }

        public function getFullPhysicalInfo($phoneLink)
        {
            $finalInfoArr = array();

            for($i = 0 ; $i < count($this -> getSpecDOM($phoneLink, 10) -> find("tr[class='attribute']")) ; $i++){
                $infoName = $this -> getSpecDOM($phoneLink, 10) -> children($i + 1) -> children(0) -> plaintext;
                $infoValue = $this -> getSpecDOM($phoneLink, 10) -> children($i + 1) -> children(1) -> plaintext;

                $infoName = str_replace(" ", "", $infoName);
                $infoValue = str_replace(" ", "", $infoValue);

                $finalInfoArr[$infoName] = $infoValue;

                //echo $infoName . ": " . $infoValue;
            }

            return $finalInfoArr;
        }

        public function getFullInfo($phoneLink)
        {
            $finalInfoArr = array();

            $finalInfoArr = array_merge($finalInfoArr, array("Nazwa" => $this -> getName($phoneLink)));

            for($i = 0 ; $i < 10 ; $i++){

                $infoArr = array();

                for($j = 0 ; $j < count($this -> getSpecDOM($phoneLink, $i) -> find("tr[class='attribute']")) ; $j++){

                    $infoName = $this -> getSpecDOM($phoneLink, $i) -> children($j + 1) -> children(0) -> plaintext;
                    $infoValue = $this -> getSpecDOM($phoneLink, $i) -> children($j + 1) -> children(1) -> plaintext;
    
                    $infoName = str_replace(" ", "", $infoName);
                    $infoValue = str_replace(" ", "", $infoValue);
    
                    $infoArr[$infoName] = $infoValue;
    
                    //echo $infoName . ": " . $infoValue;
                }

                $finalInfoArr = array_merge($finalInfoArr, $infoArr);
                unset($infoArr);

            }

            return $finalInfoArr;
        }
        
        public function getHref($phoneDOM)
        {
            return $phoneDOM -> first_child() -> children(1) -> children(1) -> first_child() -> href;
        }

        public function getPhoneLink($phoneDOM)
        {
            $phoneDir = $this -> getHref($phoneDOM);
            return "https://www.mediaexpert.pl" . $phoneDir;
        }

        public function printInfo($phoneDOM)
        {
            echo "Name: " . $this -> getName($phoneDOM) . "<br>";
            echo "Display: " . $this -> getDisplay($phoneDOM) . "<br>";
            echo "Os: " . $this -> getOs($phoneDOM) . "<br>";
            echo "RAM: " . $this -> getRam($phoneDOM) . "<br>";
            echo "Memory: " . $this -> getMemory($phoneDOM) . "<br>";
            echo "Camera: " . $this -> getCamera($phoneDOM) . "<br>";
            echo "Communication info: " . $this -> getCommunication($phoneDOM) . "<br>";
            echo "Battery: " . $this -> getBattery($phoneDOM) . "<br>";
        }

    }

?>