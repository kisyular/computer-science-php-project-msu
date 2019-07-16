<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 8:08 PM
 */

namespace Enigma;


class SettingsView extends BaseView
{
    public function presentRotors(){

        for($i=1;$i<4;$i++){
            $rotor_val = $this->getSystem()->getMyenigma()->getRotorSetting($i);
            $class = "key-A".$i;
            echo "<p class=\"key $class\">$rotor_val</p>";
        }
    }
    public function rotorOptions($rotor){
        $wheel = $this->getSystem()->getMyenigma()->getRotor(intval($rotor));
        $setting = $this->getSystem()->getMyenigma()->getRotorSetting(intval($rotor));
        $id = "rotor".$rotor."-setting";
        $nameR="rotor".$rotor;
        $nameS="setting".$rotor;
        $html = <<<HTML
<div class="options">
<p> Rotor $rotor: <select name=$nameR>
HTML;
        for($i=0;$i<5;$i++){
            $number = $this->roman($i+1);
            $val = $i+1;
            if($val === intval($wheel)){
                $html.="<option value=\"$val\" selected>$number</option>";
            } else {
                $html.="<option value=\"$val\">$number</option>";
            }
        }
        $html .= "</select></p><p>Setting: <input type=\"text\" id=$id value=\"$setting\" name=$nameS></p></div>";
        return $html;

    }
    /**
     * @param int $number
     * @return string
     */
    private function roman($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}