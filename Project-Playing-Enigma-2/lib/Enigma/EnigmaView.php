<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 9:22 AM
 */

namespace Enigma;


class EnigmaView
{
        public function __construct(System $system){
            $this->system = $system;
        }
        public function presentForm(){
            for($j=0;$j<3;$j++){
                $letter = $this->system->getMyenigma()->getRotorSetting($j+1);
                $class = "key-A".($j+1);
                echo "<p class=\"rotor-key $class\">$letter</p>";
            }
            for($i=0;$i < 26;$i++){
                $class = "key-".chr(97 + $i);
                $class2 = "key-".chr(97 + $i)."2";
                $class3 = "clicked";
                $class4 = "light";
                $key = chr(65+$i);
                if($key === $this->system->getPressedKey()){
                    $button = "<button name=\"$key\" class=\"key $class $class3\" value=\"$key\">$key</button>";
                } else{
                    $button = "<button name=\"$key\" class=\"key $class\" value=\"$key\">$key</button>";
                }
                if($key === $this->system->getLightKey()){
                    $light = "<p class=\"key $class2 $class4\">$key</p>";
                }
                else {
                    $light = "<p class=\"key $class2\">$key</p>";
                }
                echo $light;
                echo $button;
                echo "<figure class=\"key $class\"><img src=\"key.png\" alt=\"picture of letter\"></figure>";
            }

        }
        public function welcome(){
            $html = <<<HTML
<div class="welcome">
HTML;
            $html .= "<h1>Greetings, ".$this->system->getUser()->getName().", and Welcome to the Endless Enigma!</h1></div>";
            return $html;
        }
        private $system;
}