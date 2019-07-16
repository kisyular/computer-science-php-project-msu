<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/21
 * Time: 10:52 AM
 */

namespace Enigma;


class Messages extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "message");
    }
    public function getById($messageid) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($messageid));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new Message($statement->fetch(\PDO::FETCH_ASSOC));
    }
    public function get($senderid) {
        $sql =<<<SQL
SELECT * from $this->tableName
where senderid=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($senderid));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new Message($statement->fetch(\PDO::FETCH_ASSOC));
    }
    public function addMessage($message){
        $sql = <<<SQL
INSERT INTO $this->tableName(message, code, date, senderid)
values(?, ?, now(), ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        if($statement->execute(array($message->getMessage(), $message->getCode(), $message->getSenderid()))!== false){
            if($statement->rowCount() === 0) {
                return null;
            }
            $id = $this->pdo()->lastInsertId();
            return $id;
        } else {
            return null;
        }

    }
    public function recievedMessages($userid){
        $recipients = new Recipients($this->site);
        $recipientsTable = $recipients->getTableName();
        $sql = <<<SQL
SELECT m.id, m.message, m.date, m.code, m.senderid 
FROM $this->tableName m
INNER JOIN $recipientsTable
ON p2_messageid = m.id
WHERE recipientid = ?
ORDER BY m.date ASC
SQL;
        $statement = $this->pdo()->prepare($sql);
        if($statement->execute(array($userid))!== false){
            if($statement->rowCount() === 0) {
                return array();
            }
            $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $messages = [];
            foreach($rows as $row){
                $messages[] = new Message($row);
            }
            return $messages;

        } else {
            return null;
        }

    }
}