<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 8:08 PM
 */

namespace Enigma;


class SettingsView
{
    public function __construct(Site $site, System $system, array $get)
    {
        $this->system = $system;
        $this->site = $site;
        if(isset($get['e']) && intval($get['e']) === SettingsController::SETTING_ERROR){
            $this->error = "Invalid rotor settings";
        }
    }

    public function presentRotors(){

        for($i=1;$i<4;$i++){
            $rotor_val = $this->system->getMyenigma()->getRotorSetting($i);
            $class = "key-A".$i;
            echo "<p class=\"key $class\">$rotor_val</p>";
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
    public function present(){
        $html=<<<HTML
<div class="form-box-settings">
            <form method="post" action="post/settings-post.php">
HTML;
        $html.=$this->rotorOptions('1');
        $html.=$this->rotorOptions('2');
        $html.=$this->rotorOptions('3');
        $html.=<<<HTML
<div id='settings-form'>
                    <p><input type="submit" value="Set" name="set"></p>
                    <p><input type="submit" value="Clear" name="clear"></p>
                </div>
HTML;
        if($this->error){
            $html.="<p class=\"error-message\">$this->error</p>";
        }
        $html.="</form></div>";

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
    private $error = null;
    private $site;
    private $system;
}