<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/21
 * Time: 10:54 AM
 */

namespace Enigma;


class Message
{
    public function __construct($row)
    {
        $this->id = $row['id'];
        $this->message = $row['message'];
        $this->code = $row['code'];
        $this->date = $row['date'];
        $this->senderid = $row['senderid'];
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getSenderid()
    {
        return $this->senderid;
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param mixed $senderid
     */
    public function setSenderid($senderid)
    {
        $this->senderid = $senderid;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    private $message;
    private $senderid;
    private $id;
    private $date;
    private $code;
}