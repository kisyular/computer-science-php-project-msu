<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/19
 * Time: 11:24 PM
 */

namespace Enigma;


class Users extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }
    /**
     * Get a user based on the id
     * @param $email Email of the user
     * @returns User object if successful, null otherwise.
     */
    public function get($email) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));
    }
    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @returns User object if successful, null otherwise.
     */
    public function getById($userid) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($userid));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));
    }
    /**
     * Test for a valid login.
     * @param $email User email
     * @param $password Password credential
     * @returns User object if successful, null otherwise.
     */
    public function login($email, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        // Get the encrypted password and salt from the record
        $hash = $row['password'];
        $salt = $row['salt'];

        // Ensure it is correct
        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }
        return new User($row);
    }
    /**
     * Create a new user.
     * @param User $user The new user data
     * @param Email $mailer An Email object to use
     * @return null on success or error message if failure
     */
    public function sendInvite(User $user, Email $mailer) {

        // Ensure we have no duplicate email address
        if($this->exists($user->getEmail())) {
            return "Email address already exists.";
        }

        // Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validator = $validators->newValidator($user->getEmail(),$user->getName());

        // Send email with the validator in it
        // Send email with the validator in it
        $link = "http://webdev.cse.msu.edu"  . $this->site->getRoot() .
            '/password-validate.php?v=' . $validator;

        $from = $this->site->getEmail();
        $name = $user->getName();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Greetings, $name,</p>

<p>Welcome to Enigma. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($user->getEmail(), $subject, $message, $headers);
    }
    public function addUser($row){
        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(email, name, password, salt)
values(?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        if($statement->execute(array(
            $row['email'], $row['name'],$row['password'],$row['salt'])) !== false){
            $id = $this->pdo()->lastInsertId();
            return true;
        } else {
            return false;
        }

    }

    /**
     * Determine if a user exists in the system.
     * @param $email An email address.
     * @returns true if $email is an existing email address
     */
    public function exists($email) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * Set the password for a user
     * @param $userid The ID for the user
     * @param $password New password to set
     */
    public function setPassword($email, $password) {
        $salt = $this->randomSalt();
        $hash = hash("sha256", $password . $salt);
        $sql=<<<SQL
UPDATE $this->tableName
SET password=?, salt=?
WHERE email=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($hash,$salt,$email));
    }
    /**
     * Generate a random salt string of characters for password salting
     * @param $len Length to generate, default is 16
     * @returns Salt string
     */
    public static function randomSalt($len = 16) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }
    public function getUsers(){
        $sql=<<<SQL
SELECT * FROM $this->tableName
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute();
        if($statement->rowCount() === 0){
            return array();
        }
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];
        foreach($rows as $row){
            $users[] = new User($row);
        }
        return $users;
    }
    public function search($string){
        $sql=<<<SQL
select * 
from $this->tableName
where name like ?
order by name
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(['%' . $string . '%']);
        if($statement->rowCount() === 0){
            return array();
        }
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];
        foreach($rows as $row){
            $users[] = new User($row);
        }
        return $users;

    }

}