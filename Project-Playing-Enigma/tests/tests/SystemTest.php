<?php

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
require __DIR__ . "/../../vendor/autoload.php";
use Enigma\System;

class SystemTest extends \PHPUnit_Framework_TestCase
{
	public function test_construct() {
	    $username = "Abebe";
	    $system = new System($username);
        $this->assertInstanceOf('Enigma\System', $system);
	}
}

/// @endcond
