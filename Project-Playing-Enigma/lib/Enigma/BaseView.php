<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 2:29 PM
 */

namespace Enigma;


class BaseView
{
    public function __construct(System $system){
        $this->mysystem = $system;
    }

    /**
     * @return System
     */
    public function getSystem()
    {
        return $this->mysystem;
    }

    private $mysystem;
}