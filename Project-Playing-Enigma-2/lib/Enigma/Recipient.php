<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/21
 * Time: 11:00 AM
 */

namespace Enigma;


class Recipient
{
    public function __construct($row)
    {
        $this->messageid = $row['messageid'];
        $this->recipientid = $row['recipientid'];
    }

    /**
     * @return mixed
     */
    public function getRecipientid()
    {
        return $this->recipientid;
    }

    /**
     * @return mixed
     */
    public function getMessageid()
    {
        return $this->messageid;
    }

    /**
     * @param mixed $recipientid
     */
    public function setRecipientid($recipientid)
    {
        $this->recipientid = $recipientid;
    }

    /**
     * @param mixed $messageid
     */
    public function setMessageid($messageid)
    {
        $this->messageid = $messageid;
    }

    private $recipientid;
    private $messageid;

}