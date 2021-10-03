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
            
        }

        public function getFullFunctionInfo($phoneLink)
        {
            
        }

        public function getFullCommunicationInfo($phoneLink)
        {
            
        }

        public function getFullMultimediaInfo($phoneLink)
        {
            
        }

        public function getFullTechInfo($phoneLink)
        {
            
        }

        public function getFullDisplayInfo($phoneLink)
        {
            
        }

        public function getFullPowerSuppInfo($phoneLink)
        {
            
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