<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 9:57 AM
 */
require __DIR__ . "/../vendor/autoload.php";
use Enigma\System;


// Start the PHP session system
session_start();
define("SYSTEM_SESSION", 'system');

if(!isset($_SESSION[SYSTEM_SESSION]) && $_SERVER['SCRIPT_NAME'] !== '/~tesfami1/project1/index.php'){
    header('location:~/../index.php');
    exit;
}
if(!isset($_SESSION[SYSTEM_SESSION])) {
    $_SESSION[SYSTEM_SESSION] = new System();
}


$system = $_SESSION[SYSTEM_SESSION];
$msg = false;
if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
    $msg = true;
    $message = $_SESSION['message'];
}
$setmsg=false;
if(isset($_SESSION['setting_message']) && !empty($_SESSION['setting_message']) && $_SESSION['setting_message'] !== false){
    $setmsg = true;
    $setting_message = $_SESSION['setting_message'];
}


