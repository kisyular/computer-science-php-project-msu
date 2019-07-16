<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 2:29 PM
 */

namespace Enigma;


class BaseController
{
    public function __construct(System $system, $post){
        $this->mysystem = $system;
        $this->post = $post;
    }

    /**
     * @return System
     */
    public function getSystem()
    {
        return $this->mysystem;
    }

    /**
     * @return mixed
     */
    public function getPost(){
        return $this->post;
    }
    private $mysystem;
    private $post;
}