<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 6:56 PM
 */

namespace Enigma;


class ReceiveController extends CommunicateController
{
    public function __construct(Site $site, System $system, array $post){
        parent::__construct($site,$system,$post, "receive.php");
        $root = $site->getRoot();
        if(isset($post['viewMessage'])){
            if(isset($post['re-message'])){
                $this->redirect = "$root/receive.php?v=".$post['re-message'];
                return;
            } else {
                $this->redirect = "$root/receive.php?e=". self::SELECT_MESSAGE;
                return;
            }
        }

    }
    const SELECT_MESSAGE = 7;
}