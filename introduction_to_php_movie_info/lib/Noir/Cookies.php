<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/26
 * Time: 11:15 PM
 */

namespace Noir;


class Cookies extends Table
{
    /**
     * Create a new cookie token
     * @param $user User to create token for
     * @return New 32 character random string
     */
    public function create($user) {
        $bytes = openssl_random_pseudo_bytes(32);
        $str = bin2hex($bytes);
        $sql=<<<SQL
insert into $this->tableName(user,salt,hash,date)
values(?,?,?, now());
SQL;

    }

    /**
     * Validate a cookie token
     * @param $user User ID
     * @param $token Token
     * @return null|string If successful, return the actual
     *   hash as stored in the database.
     */
    public function validate($user, $token) {

    }

    /**
     * Delete a hash from the database
     * @param $hash Hash to delete
     * @return bool True if successful
     */
    public function delete($hash) {

    }

}