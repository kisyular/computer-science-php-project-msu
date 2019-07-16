<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 8:08 PM
 */

namespace Enigma;


class SettingsController extends BaseController
{
    public function handleSet(&$message){
//        $this->rotors = [
//            1=>['rotor'=>1, 'setting'=>'A'],
//            2=>['rotor'=>2, 'setting'=>'A'],
//            3=>['rotor'=>3, 'setting'=>'A']
//        ];
        if($this->getPost()['submit'] === 'Set'){
            if(($this->getPost()['rotor1'] === $this->getPost()['rotor2']) ||
            ($this->getPost()['rotor2'] === $this->getPost()['rotor3']) ||
            ($this->getPost()['rotor1'] === $this->getPost()['rotor3'])){
                $message = "Invalid rotor numbers";
            } else {
                foreach($this->getPost() as $key => $value){
                    if(strpos($key,'rotor') !== false){
                        $this->getSystem()->getMyenigma()->setRotor(intval(substr($key,-1)),$value);
                    } else if(strpos($key,'setting') !== false) {
                        $this->getSystem()->getMyenigma()->setRotorSetting(intval(substr($key,-1)),strtoupper($value));
                    }
                }
                if(isset($message)){
                    $message = false;
                }


            }
            $this->getSystem()->setMSetting($this->getSystem()->getMyenigma()->getRotorsArray());
            $this->page = "settings.php";
        } else {
            $this->page = "settings.php";
        }
    }

    /**
     * @return mixed
     */
    public function getPage(){
        return $this->page;
    }
    private $page;

}