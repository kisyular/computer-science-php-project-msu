<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 10:30 PM
 */

namespace Enigma;


class BatchController extends BaseController
{
    public function handleBatch(){
        if($this->getPost()['submit'] === 'Encode ->'){
            $str = '';
            $encoded='';
            $array = str_split($this->getPost()['plain']);
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
                $encoded.=$this->getSystem()->getMyenigma()->pressed($char);
                $count++;
                if($count === 5){
                    $encoded.=' ';
                    $count=0;
                }

            }
            $this->getSystem()->setPlainBatch($this->getPost()['plain']);
            $this->getSystem()->setEncodedBatch($encoded);

        } else if($this->getPost()['submit'] === 'Decode <-'){
            $str = '';
            $decoded='';
            $array = str_split($this->getPost()['encoded']);
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
                $decoded.=$this->getSystem()->getMyenigma()->pressed($char);
                $count++;
                if($count === 5){
                    $decoded.=' ';
                    $count=0;
                }

            }
            $this->getSystem()->setPlainBatch($decoded);
            $this->getSystem()->setEncodedBatch($this->getPost()['encoded']);

        } else if($this->getPost()['submit'] === 'Reset'){
            $this->getSystem()->getMyenigma()->setRotorsArray($this->getSystem()->getMSetting());
        }
    }
}