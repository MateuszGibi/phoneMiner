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

        public function getName($phoneDOM)
        {   
            return $phoneDOM -> first_child() -> children(1) -> children(1) -> first_child() -> plaintext;
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
                //echo $paramName . "<br>";
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
            //hehe

            $finalInfoArr = array();

            for($i = 1 ; $i < 2 ; $i++){
                $techName = $this -> getSpecDOM($phoneLink, 7) -> children($i) -> children(0) -> plaintext;
                $techValue = $this -> getSpecDOM($phoneLink, 7) -> children($i) -> children(1) -> plaintext;
                
                //$techName = str_replace(" ","",$techName);

                for($i = 0 ; $i < 16 ; $i++){
                    echo $techName[$i] . "<br>";
                }
                
                switch($techName){
                    case "Pamięć RAM":
                        $finalInfoArr["ram"] = $techValue;
                        break;
                    case " Liczba rdzeni procesora ":
                        $finalInfoArr["cpu_core_number"] = $techValue;
                        break;
                    case "Maksymalna pojemność karty pamięci [GB] ":
                        $finalInfoArr["max_sd_memory"] = $techValue;
                        break;
                    case " DLNA ":
                        $finalInfoArr["dlna"] = $techValue;
                        break;
                    case " ANR+ ":
                        $finalInfoArr["anr+"] = $techValue;
                        break;
                    case " Wodoodporność ":
                        $finalInfoArr["waterproof"] = $techValue;
                        break;
                    case "Pyłoszczelność ":
                        $finalInfoArr["dustproof"] = $techValue;
                        break;
                    case " Pamięć wbudowana [GB] ":
                        $finalInfoArr["buildin_memory"] = $techValue;
                        break;
                    case " Model procesora ":
                        $finalInfoArr["cpu_model"] = $techValue;
                        break;
                    case " Dual SIM ":
                        $finalInfoArr["dual_sim"] = $techValue;
                        break;
                    case "Częstotliwość taktowania procesora [GHz] ":
                        $finalInfoArr["cpu_clock"] = $techValue;
                        break;
                    case " Wyjście słuchawkowe ":
                        $finalInfoArr["hp_input"] = $techValue;
                        break;
                    case " Standard karty SIM ":
                        $finalInfoArr["sim_standart"] = $techValue;
                        break;
                    case " NFC ":
                        $finalInfoArr["nfc"] = $techValue;
                        break;
                    case " Typ złącza USB ":
                        $finalInfoArr["usb_type"] = $techValue;
                        break;
                    case " Czytnik kart pamięci ":
                        $finalInfoArr["sd_slot"] = $techValue;
                        break;
                }
            }

            return $finalInfoArr;


        }

        public function getFullDisplayInfo($phoneLink)
        {
            
        }

        public function getFullPowerSuppInfo($phoneLink)
        {
            //hehe
        }

        public function getFullPhysicalInfo($phoneLink)
        {
            
        }

        public function getProducerName($phoneLink)
        {
            
        }

        public function getFullInfo()
        {

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