<?php

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
require __DIR__ . "/../../vendor/autoload.php";

class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function test_getEmail() {
		//$this->assertEquals($expected, $actual);
        $site = new Felis\Site();
        $this->assertEquals('', $site->getEmail());
	}
    public function test_setEmail() {
        //$this->assertEquals($expected, $actual);
        $site = new Felis\Site();
        $site->setEmail('abebe@gmail.com');
        $this->assertEquals('abebe@gmail.com', $site->getEmail());
    }
	public function test_getRoot(){
        $site = new Felis\Site();
        $this->assertEquals('',$site->getRoot());
    }
    public function test_setRoot(){
        $site = new Felis\Site();
        $site->setRoot('abebe');
        $this->assertEquals('abebe',$site->getRoot());
    }
    public function test_getTablePrefix(){
        $site = new Felis\Site();
        $this->assertEquals('',$site->getTablePrefix());
    }
    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test_', $site->getTablePrefix());
    }
}

/// @endcond
