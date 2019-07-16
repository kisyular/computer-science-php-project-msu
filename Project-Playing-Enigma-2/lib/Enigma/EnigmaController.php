<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 9:22 AM
 */

namespace Enigma;


class EnigmaController
{
    public function __construct(Site $site, System $system, array $post){
        $encoded = null;
        foreach($post as $key => $value){
            if($key !== 'reset'){
                $encoded = $system->encode($value);
                $system->setPressedKey($key);
                $system->setLightKey($encoded);
                unset($post[$key]);
            } else {
                $system->setReset(true);
                $system->setPressedKey(null);
                $system->setLightKey(null);
                $system->getMyenigma()->setRotorsArray($system->getMSetting());
            }
        }
    }
}