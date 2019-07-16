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
    public function __construct(User $user){
        $this->user = $user;
        $this->myenigma = new Enigma();
        $this->msetting = [
            1=>['rotor'=>1, 'setting'=>'A'],
            2=>['rotor'=>2, 'setting'=>'A'],
            3=>['rotor'=>3, 'setting'=>'A']
        ];
    }
    public function getCode(){
        return $this->code;
    }
    public function setCode($code){
        $this->code = $code;
    }
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
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
    public function useCode($code){
        $c1 = $this->myenigma->pressed(substr($code, 0, 1));
        $c2 = $this->myenigma->pressed(substr($code, 1, 1));
        $c3 = $this->myenigma->pressed(substr($code, 2, 1));

        $this->myenigma->setRotorSetting(1, $c1);
        $this->myenigma->setRotorSetting(2, $c2);
        $this->myenigma->setRotorSetting(3, $c3);
    }
    public function encodeBatch($plain){
        $str = '';
        $encoded='';
        $array = str_split($plain);
        foreach($array as $char){
            if((ord(strtoupper($char))>= 65 && ord(strtoupper($char))<=90) ||
                (ord($char) === 46) || (ord(strtoupper($char))>= 48 && ord(strtoupper($char))<=57)){
                switch($char){
                    case ' ':
                        break;
                    case '.':
                        $str.='X';
                        break;
                    case '0':
                        $str.='NULL';
                        break;
                    case '1':
                        $str.='EINZ';
                        break;
                    case '2':
                        $str.='ZWO';
                        break;
                    case '3':
                        $str.='DREI';
                        break;
                    case '4':
                        $str.='VIER';
                        break;
                    case '5':
                        $str.='FUNF';
                        break;
                    case '6':
                        $str.='SEQS';
                        break;
                    case '7':
                        $str.='SIEBEN';
                        break;
                    case '8':
                        $str.='AOT';
                        break;
                    case '9':
                        $str.='NEUN';
                        break;
                    default:
                        $str.=strtoupper($char);
                }
            }

        }
        $array2 = str_split($str);
        $count = 0;
        foreach($array2 as $char){
            $encoded.=$this->myenigma->pressed($char);
            $count++;
            if($count === 5){
                $encoded.=' ';
                $count=0;
            }

        }
        return $encoded;
    }
    public function decodeBatch($encrypted){
        $str = '';
        $decoded='';
        $array = str_split($encrypted);
        foreach($array as $char){
            if((ord(strtoupper($char))>= 65 && ord(strtoupper($char))<=90) ||
                (ord($char) === 46) || (ord(strtoupper($char))>= 48 && ord(strtoupper($char))<=57)){
                switch($char){
                    case ' ':
                        break;
                    case '.':
                        $str.='X';
                        break;
                    case '0':
                        $str.='NULL';
                        break;
                    case '1':
                        $str.='EINZ';
                        break;
                    case '2':
                        $str.='ZWO';
                        break;
                    case '3':
                        $str.='DREI';
                        break;
                    case '4':
                        $str.='VIER';
                        break;
                    case '5':
                        $str.='FUNF';
                        break;
                    case '6':
                        $str.='SEQS';
                        break;
                    case '7':
                        $str.='SIEBEN';
                        break;
                    case '8':
                        $str.='AOT';
                        break;
                    case '9':
                        $str.='NEUN';
                        break;
                    default:
                        $str.=strtoupper($char);
                }
            }

        }
        $array2 = str_split($str);
        $count = 0;
        foreach($array2 as $char){
            $decoded.=$this->myenigma->pressed($char);
            $count++;
            if($count === 5){
                $decoded.=' ';
                $count=0;
            }

        }
        return $decoded;

    }
    protected $user;
    private $msetting;
    private $myenigma;
    private $pressedKey;
    private $lightKey;
    private $reset;
    private $encodedBatch;
    private $plainBatch;
    private $code=null;
}