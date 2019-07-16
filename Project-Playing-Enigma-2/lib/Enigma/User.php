<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/19
 * Time: 11:25 PM
 */

namespace Enigma;


class User
{
    public function __construct($row){
        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->name = $row['name'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    private $name;
    private $email;
    private $id;
    const USER_SESSION = 'user';

}