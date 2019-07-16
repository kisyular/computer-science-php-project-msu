<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 7:39 PM
 */

namespace Enigma;


class CommunicateController
{
    public function __construct(Site $site, System $system, array $post, $page){
        $this->system = $system;
        $root = $site->getRoot();
        if(isset($post['set'])){
            if(($post['rotor1'] === $post['rotor2']) ||
                ($post['rotor2'] === $post['rotor3']) ||
                ($post['rotor1'] === $post['rotor3'])){
                $this->redirect = "$root/$page?e=".self::SETTING_ERROR;
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
            $this->redirect = "$root/$page";
            return;
        } else if(isset($post['clear'])) {
            $this->redirect = "$root/$page";
            return;
        }
        if(isset($post['encode'])){
            // Then, assuming the three letters are in $code, we do:
            if(isset($post['code']) && !empty($post['code']) && strlen($post['code']) < 4){
                $code = strtoupper(strip_tags($post['code']));
                $system->setCode($code);
                $system->useCode($code);
                $encoded = $system->encodeBatch($post['plain']);
                $system->setPlainBatch($post['plain']);
                $system->setEncodedBatch($encoded);
                $this->redirect = "$root/send.php";
                return;
            } else {
                $this->redirect = "$root/send.php?e=".self::NO_CODE;
            }

        }
    }


    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    protected $redirect;  ///< Page we will redirect the user to.
    private $system;
    const SETTING_ERROR=8;
    const NO_CODE = 6;

}