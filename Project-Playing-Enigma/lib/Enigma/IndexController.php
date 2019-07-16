<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 2:37 PM
 */

namespace Enigma;


class IndexController extends BaseController
{
    public function getPage(){
        return $this->page;
    }
    public function handlePost(&$message){
        if(!isset($this->getPost()['user']) || empty($this->getPost()['user'])){
            $message = "Enter a valid username!";
            $this->page = "index.php";
        } else {
            $username = strip_tags($this->getPost()['user']);
            $this->getSystem()->setUsername($username);
            if(isset($message)){
                unset($message);
            }
            $this->page = "enigma.php";
        }
    }
    private $page;
    private $reset;
}