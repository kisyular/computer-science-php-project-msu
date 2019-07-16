<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 8:08 PM
 */

namespace Enigma;


class SettingsController
{
    public function __construct(Site $site, System $system, array $post){
        $this->system = $system;
        $root = $site->getRoot();
        if(isset($post['set'])){
            if(($post['rotor1'] === $post['rotor2']) ||
                ($post['rotor2'] === $post['rotor3']) ||
                ($post['rotor1'] === $post['rotor3'])){
                $this->redirect = "$root/settings.php?e=".self::SETTING_ERROR;
                return;
            } else {
                foreach($post as $key => $value){
                    if(strpos($key,'rotor') !== false){
                        $system->getMyenigma()->setRotor(intval(substr($key,-1)),$value);
                    } else if(strpos($key,'setting') !== false) {
                        $system->getMyenigma()->setRotorSetting(intval(substr($key,-1)),strtoupper($value));
                    }
                }
            }
            $system->setMSetting($system->getMyenigma()->getRotorsArray());
            $this->redirect = "$root/settings.php";
        } else {
            $this->redirect = "$root/settings.php";
        }

    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    private $redirect;  ///< Page we will redirect the user to.
    private $system;
    const SETTING_ERROR=4;

}