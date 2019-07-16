<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 1:53 AM
 */

namespace Enigma;


class Validators extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "validator");
    }

    /**
     * Create a new validator and add it to the table.
     * @param $userid User this validator is for.
     * @return The new validator.
     */
    public function newValidator($email, $name) {
        $validator = $this->createValidator();

        // Write to the table
        $sql = <<<SQL
insert into $this->tableName(email, validator, date, name)
values(?, ?, now(), ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute(array($email, $validator, $name)) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $validator;
    }
    /**
     * Generate a random validator string of characters
     * @param $len Length to generate, default is 32
     * @returns Validator string
     */
    public function createValidator($len = 32) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }
    /**
     * Determine if a validator is valid. If it is,
     * return the user ID for that validator.
     * @param $validator Validator to look up
     * @return user email or null if not found.
     */
    public function get($validator) {
        $sql=<<<SQL
SELECT * FROM $this->tableName
WHERE validator=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($validator));
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if(count($row)=== 0){
            return null;
        }
        return [$row['email'],$row['name']];
    }

    /**
     * Remove any validators for this user ID.
     * @param $userid The USER ID we are clearing validators for.
     */
    public function remove($email)
    {
        $sql=<<<SQL
DELETE FROM $this->tableName
WHERE email=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try{
            if(!$statement->execute(array($email))){
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