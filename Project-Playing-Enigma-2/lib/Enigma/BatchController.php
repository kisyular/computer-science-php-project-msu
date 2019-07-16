<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 10:30 PM
 */

namespace Enigma;


class BatchController
{
    public function __construct(Site $site, System $system, array $post){
        if($post['submit'] === 'Encode ->'){
            $str = '';
            $encoded='';
            $array = str_split($post['plain']);
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
                $encoded.=$system->getMyenigma()->pressed($char);
                $count++;
                if($count === 5){
                    $encoded.=' ';
                    $count=0;
                }

            }
            $system->setPlainBatch($post['plain']);
            $system->setEncodedBatch($encoded);

        } else if($post['submit'] === 'Decode <-'){
            $str = '';
            $decoded='';
            $array = str_split($post['encoded']);
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
                $decoded.=$system->getMyenigma()->pressed($char);
                $count++;
                if($count === 5){
                    $decoded.=' ';
                    $count=0;
                }

            }
            $system->setPlainBatch($decoded);
            $system->setEncodedBatch(strip_tags($post['encoded']));

        } else if($post['submit'] === 'Reset'){
            $system->getMyenigma()->setRotorsArray($system->getMSetting());
        }
    }

}