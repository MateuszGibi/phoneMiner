<?php 

    require_once("lib/simple_html_dom.php");

    class PhoneMiner{

        //Returns phone's htmlDOM of index
        public function getPhoneDOM(object $html, int $index) : object
        {
            return $html -> find("div[class='offer-box']", $index) -> children(0);
        }

        //Returns href to phone's site
        public function getHref(object $phoneDOM) : string
        {
            return $phoneDOM -> first_child() -> children(1) -> children(1) -> first_child() -> href;
        }
        
        //Returns link to phone's site
        public function getPhoneLink(object $phoneDOM) : string
        {
            $phoneDir = $this -> getHref($phoneDOM);
            return "https://www.mediaexpert.pl" . $phoneDir;
        }

        //Returns htmlDOM of phone's specification of index
        public function getSpecDOM(object $phoneHtml, int $index) : object
        {
            return $phoneHtml -> find("div[class='specification']", 0) -> children(1) -> first_child() -> children($index);
        }

        //Returns name of a phone's model
        public function getName(object $phoneHtml) : string{
            $name = $phoneHtml -> find("h1[class='name is-title']" ,0) -> plaintext;

            $name = htmlspecialchars_decode($name);

            return $name;
        }

        //Returs link to phone's image of index
        public function getImageLink(object $phoneHtml, int $index) : string{
            $imageDom = $phoneHtml -> find("div[class='slides is-type-horizontal']", 1) -> find("div[class='spark-slide item-slide']", $index);
            return $imageDom -> first_child() -> first_child() -> first_child() -> src;
        }

        //Returns all links of phone's images
        public function getImages(object $phoneHtml) : array{
            $imagesArr = array();

            //Number of images found on site
            $numOfImages = count($phoneHtml -> find("div[class='slides is-type-horizontal']", 1) -> find("div[class='spark-slide item-slide']"));
            
            //Loop to add all links to array
            for($i = 0 ; $i < $numOfImages ; $i++){
                $imgLink = $this -> getImageLink($phoneHtml, $i);

                //Replace name of folder for higher resolution
                $imgLink = str_replace("gallery_100_100","gallery", $imgLink);
                //Add link to array
                array_push($imagesArr, $imgLink);
            }
            
            return $imagesArr;
            
        }

        //Returns all informations of phone as an array
        public function getFullInfo(object $phoneHtml) : array
        {
            $finalInfoArr = array();

            //Add phone's model name to array
            $finalInfoArr = array_merge($finalInfoArr, array("Nazwa" => $this -> getName($phoneHtml)));

            //Add phone's images links to array
            $finalInfoArr = array_merge($finalInfoArr, array("Images" => @$this -> getImages($phoneHtml)));

            //Loop to go through all spec's sections
            for($i = 0 ; $i < 10 ; $i++){

                //Array for all information in current section
                $infoArr = array();
                //Number of specifications to get
                $specNum = count($this -> getSpecDOM($phoneHtml, $i) -> find("tr[class='attribute']"));

                //Loop to get all information of a current section
                for($j = 0 ; $j < $specNum ; $j++){

                    //Get name and value of specification
                    $infoName = $this -> getSpecDOM($phoneHtml, $i) -> children($j + 1) -> children(0) -> plaintext;
                    $infoValue = $this -> getSpecDOM($phoneHtml, $i) -> children($j + 1) -> children(1) -> plaintext;
                    
                    //Strip of spaces from name and value
                    $infoName = str_replace(" ", "", $infoName);
                    $infoValue = str_replace(" ", "", $infoValue);
                    
                    //Add specification's value to assoc array
                    $infoArr[$infoName] = $infoValue;

                }

                //Add specification array to final array
                $finalInfoArr = array_merge($finalInfoArr, $infoArr);

                //Clear specification array
                unset($infoArr);

            }

            return $finalInfoArr;
        }
        
    }

?>