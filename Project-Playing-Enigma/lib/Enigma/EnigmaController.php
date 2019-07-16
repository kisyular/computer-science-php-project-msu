<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 9:22 AM
 */

namespace Enigma;


class EnigmaController extends BaseController
{
    public function handleClick(){
        $encoded = null;
        foreach($this->getPost() as $key => $value){
            if($key !== 'reset'){
                $encoded = $this->getSystem()->encode($value);
                $this->getSystem()->setPressedKey($key);
                $this->getSystem()->setLightKey($encoded);
                unset($this->getPost()[$key]);
            } else {
                $this->getSystem()->setReset(true);
                $this->getSystem()->setPressedKey(null);
                $this->getSystem()->setLightKey(null);
                $this->getSystem()->getMyenigma()->setRotorsArray($this->getSystem()->getMSetting());
            }
        }
    }
}