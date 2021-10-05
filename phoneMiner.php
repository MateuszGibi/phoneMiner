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

        public function getHref($phoneDOM)
        {
            return $phoneDOM -> first_child() -> children(1) -> children(1) -> first_child() -> href;
        }

        public function getPhoneLink($phoneDOM)
        {
            $phoneDir = $this -> getHref($phoneDOM);
            return "https://www.mediaexpert.pl" . $phoneDir;
        }
        
        public function getName($phoneLink){
            $name = $phoneLink -> find("h1[class='name is-title']" ,0) -> plaintext;

            $name = htmlspecialchars_decode($name);

            return $name;
        }

        public function getImageLink($phoneLink, $index){
            $imageDom = $phoneLink -> find("div[class='slides is-type-horizontal']", 1) -> find("div[class='spark-slide item-slide']", $index);
            return $imageDom -> first_child() -> first_child() -> first_child() -> src;
        }

        public function getImages($phoneLink){
            $imagesArr = array();

            $numOfImages = count($phoneLink -> find("div[class='slides is-type-horizontal']", 1) -> find("div[class='spark-slide item-slide']"));
            for($i = 0 ; $i < $numOfImages ; $i++){
                $imgLink = $this -> getImageLink($phoneLink, $i);
                $imgLink = str_replace("gallery_100_100","gallery", $imgLink);
                array_push($imagesArr, $imgLink);
            }
            
            return $imagesArr;
            
        }

        public function getFullInfo($phoneLink)
        {
            $finalInfoArr = array();

            $finalInfoArr = array_merge($finalInfoArr, array("Nazwa" => $this -> getName($phoneLink)));

            $finalInfoArr = array_merge($finalInfoArr, @$this -> getImages($phoneLink));

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
        
    }

?>