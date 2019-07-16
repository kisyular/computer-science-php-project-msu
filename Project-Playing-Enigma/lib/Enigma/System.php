<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 10:12 AM
 */

namespace Enigma;


class System
{
    public function __construct($username= null){
        $this->username = $username;
        $this->myenigma = new Enigma();
        $this->msetting = [
            1=>['rotor'=>1, 'setting'=>'A'],
            2=>['rotor'=>2, 'setting'=>'A'],
            3=>['rotor'=>3, 'setting'=>'A']
        ];
    }

    /**
     * @return $username
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getMSetting(){
        return $this->msetting;
    }
    public function setMSetting($setting){
        $this->msetting = $setting;
    }

    /**
     * @return Enigma
     */
    public function getMyenigma(){
        return $this->myenigma;
    }
    public function encode($str){
        return $this->myenigma->pressed($str);
    }
    /**
     * @param mixed $pressedKey
     */
    public function setPressedKey($pressedKey){
        $this->pressedKey = $pressedKey;
    }
    /**
     * @param mixed $lightKey
     */
    public function setLightKey($lightKey){
        $this->lightKey = $lightKey;
    }

    /**
     * @return mixed
     */
    public function getLightKey(){
        return $this->lightKey;
    }

    /**
     * @return mixed
     */
    public function getPressedKey(){
        return $this->pressedKey;
    }
    /**
     * @param mixed $reset
     */
    public function setReset($reset){
        $this->reset = $reset;
        if($this->reset){
            $this->myenigma->setRotorsArray($this->msetting);
        }
    }

    /**
     * @return mixed
     */
    public function getEncodedBatch()
    {
        return $this->encodedBatch;
    }

    /**
     * @return mixed
     */
    public function getPlainBatch()
    {
        return $this->plainBatch;
    }

    /**
     * @param mixed $encodedBatch
     */
    public function setEncodedBatch($encodedBatch)
    {
        $this->encodedBatch = $encodedBatch;
    }

    /**
     * @param mixed $plainBatch
     */
    public function setPlainBatch($plainBatch)
    {
        $this->plainBatch = $plainBatch;
    }
    private $username;
    private $msetting;
    private $myenigma;
    private $pressedKey;
    private $lightKey;
    private $reset;
    private $encodedBatch;
    private $plainBatch;
}