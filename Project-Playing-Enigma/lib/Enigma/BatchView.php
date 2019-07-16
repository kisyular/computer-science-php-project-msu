<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 10:30 PM
 */

namespace Enigma;


class BatchView extends BaseView
{
    public function presentRotors(){

        for($i=1;$i<4;$i++){
            $rotor_val = $this->getSystem()->getMyenigma()->getRotorSetting($i);
            $class = "key-A".$i;
            echo "<p class=\"key $class\">$rotor_val</p>";
        }
    }
    public function presentTextArea(){
        $val = $this->getSystem()->getPlainBatch();
        $encodedVal = $this->getSystem()->getEncodedBatch();
        echo "<textarea name=\"plain\" cols=\"30\" rows=\"5\">$val</textarea>";
        echo "<textarea name=\"encoded\" cols=\"30\" rows=\"5\">$encodedVal</textarea>";
    }
}