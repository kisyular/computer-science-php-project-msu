<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 9:57 AM
 */
require __DIR__ . "/../vendor/autoload.php";


// Start the PHP session system
session_start();
$site = new Enigma\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}
//if(!isset($_SESSION[SYSTEM_SESSION]) && $_SERVER['SCRIPT_NAME'] !== '/~tesfami1/project1/index.php'){
//    header('location:~/../index.php');
//    exit;
//}
if(isset($_SESSION[Enigma\User::USER_SESSION])) {
    $system = $_SESSION[Enigma\User::USER_SESSION];
}

// redirect if user is not logged in
if(!isset($open) && $system === null) {
    $root = $site->getRoot();
    header("location: $root/");
    exit;
}


