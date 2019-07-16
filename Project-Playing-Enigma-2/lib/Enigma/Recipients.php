<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/21
 * Time: 10:59 AM
 */

namespace Enigma;


class Recipients extends Table
{
    public function __construct(Site $site)
    {
        parent::__construct($site, "recipient");
    }
    public function addRecipient($recipient){
        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(recipientid, p2_messageid)
values(?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        if($statement->execute(array($recipient->getRecipientid(),$recipient->getMessageid()))!== false){
            if($statement->rowCount() === 0) {
                return false;
            }
            $id = $this->pdo()->lastInsertId();
            return true;
        } else {
            return false;
        }
    }
}