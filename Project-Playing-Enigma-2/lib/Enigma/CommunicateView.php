<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 7:35 PM
 */

namespace Enigma;


class CommunicateView
{
    public function __construct(Site $site, System $system, array $get)
    {
        $this->system = $system;
        $this->site = $site;
        if(isset($get['e'])){
            $this->error = intval($get['e']);
        }
    }

    public function rotorOptions($rotor){
        $wheel = $this->system->getMyenigma()->getRotor(intval($rotor));
        $setting = $this->system->getMyenigma()->getRotorSetting(intval($rotor));
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
    public function presentTextArea(){
        $val = $this->system->getPlainBatch();
        $encodedVal = $this->system->getEncodedBatch();
        $html="<textarea name=\"plain\" cols=\"30\" rows=\"5\">$val</textarea>";
        $html.="<textarea name=\"encoded\" cols=\"30\" rows=\"5\">$encodedVal</textarea>";
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
    protected $error = null;
    protected $site;
    protected $system;

}