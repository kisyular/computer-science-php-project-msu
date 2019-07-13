<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/02
 * Time: 10:44 PM
 */
require __DIR__ . "/../vendor/autoload.php";
// Start the PHP session system
session_start();
define("GUESSING_SESSION", 'guessing');
if(!isset($_SESSION[GUESSING_SESSION])) {
    $_SESSION[GUESSING_SESSION] = new Guessing\Guessing();
}
if(isset($_GET['seed'])) {
    $_SESSION[GUESSING_SESSION] = new Guessing\Guessing(strip_tags($_GET['seed']));
}

$guessing = $_SESSION[GUESSING_SESSION];