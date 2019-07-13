<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 8:07 PM
 */

namespace Felis;


class Cases extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "case");
    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @returns Object that represents the case if successful,
     *  null otherwise.
     */
    public function get($id) {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));
    }
    public function insert($client, $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, number, summary, status)
values(?, ?, ?, "", ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute(array($client,
                        $agent,
                        $number,
                        ClientCase::STATUS_OPEN)
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }
    public function getCases(){
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql =<<<SQL
SELECT c.id, c.client,c.agent, c.number, agents.name as agentName, clients.name as clientName, c.status, c.summary 
from $this->tableName c
inner join $usersTable  agents
inner join $usersTable  clients
on c.agent = agents.id and c.client = clients.id
order by c.status DESC, c.number ASC 
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();
        if($statement->rowCount() === 0) {
            return array();
        }
        $arr = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $cases = [];
        foreach($arr as $row){
            $cases[] = new ClientCase($row);
        }
        return $cases;

    }
    public function update(ClientCase $case) {
        $sql =<<<SQL
UPDATE $this->tableName
SET agent=?, number=?, status=?, summary=?
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try{
            if(!$statement->execute(array($case->getAgent(),$case->getNumber(),$case->getStatus(),
                $case->getSummary(), $case->getId()))){
                return false;
            } else{
                if($statement->rowCount() === 0){
                    return false;
                } else {
                    return true;
                }
            }

        } catch(\PDOException $e) {
            return false;
        }
    }
    public function delete($id){
        $sql =<<<SQL
DELETE FROM $this->tableName
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try{
            if(!$statement->execute(array($id))){
                return false;
            } else{
                if($statement->rowCount() === 0){
                    return false;
                } else {
                    return true;
                }
            }

        } catch(\PDOException $e) {
            return false;
        }
    }
}