<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/02
 * Time: 10:37 PM
 */

namespace Guessing;


class Guessing
{
    const MIN = 1;
    const MAX = 100;

    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
    }

    /**
     * @return int
     */
    public function getNumGuesses()
    {
        return $this->number;
    }
    public function check(){

    }
    public function getGuess(){

    }
    private $number;

}