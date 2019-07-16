<?php
/**
 * Created by PhpStorm.
 * User: Rellika Kisyula
 * Date: 2018/06/08
 * Time: 3:25 PM
 */
require __DIR__ . "/vendor/autoload.php";
//require 'lib/enigma.inc.php';

if(isset($_SESSION[SYSTEM_SESSION])){
    unset($_SESSION[SYSTEM_SESSION]);
}
if(isset($_SESSION['message'])){
    unset($_SESSION['message']);
}
header("location:index.php");
exit;