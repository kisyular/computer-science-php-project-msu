<?php

/** @file
 * Empty unit testing template/database version
 * @cond 
 * Unit tests for the class
 */

require __DIR__ . "/../../vendor/autoload.php";

class UsersTest extends \PHPUnit_Extensions_Database_TestCase
{

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {

        return $this->createDefaultDBConnection(self::$site->pdo(), 'tesfami1');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');

        //return $this->createFlatXMLDataSet(dirname(__FILE__) . 
		//	'/db/users.xml');
    }
    public function test_construct() {
        $users = new Felis\Users(self::$site);
        $this->assertInstanceOf('Felis\Users', $users);
    }
    public function test_get(){
        $users = new Felis\Users(self::$site);

        // Test a valid get based on id
        $user = $users->get(8);
        $this->assertInstanceOf('Felis\User', $user);

        // Test a failed get
        $user = $users->get(6);
        $this->assertNull($user);

    }
    public function test_login() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertEquals("cbowen@cse.msu.edu",$user->getEmail());
        $this->assertEquals("Owen Address",$user->getAddress());
        $this->assertEquals("8",$user->getId());
        $this->assertEquals("Owen, Charles",$user->getName());
        $time = strtotime("2015-01-01 23:50:26");
        $this->assertEquals($time,$user->getJoined());
        $this->assertEquals("999-999-9999",$user->getPhone());
        $this->assertEquals("A",$user->getRole());
        $this->assertEquals("Owen Notes",$user->getNotes());

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);
    }
    public function test_update(){
        $users = new Felis\Users(self::$site);
        $array = array("id"=>7, "email"=>"aaaa@dude.com", "name"=>"Dudess, The","phone"=>"111-222-3333",
                    "address"=>"aaaa Address" ,"notes"=>"Dudess Notes", "password"=>"87654321",
               "joined"=>"2015-01-22 23:50:26" ,"role"=>"S");
        //a valid update
        $user = new Felis\User($array);
        $this->assertTrue($users->update($user));
        //constraint violation
        $user->setEmail("cbowen@cse.msu.edu");
        $this->assertFalse($users->update($user));
        //when user doesn't exist
        $array['id'] = 6;
        $user = new Felis\User($array);
        $this->assertFalse($users->update($user));
        //Nothing modified
        $user = $users->get(9);
        $this->assertFalse($users->update($user));
    }
	
}

/// @endcond
