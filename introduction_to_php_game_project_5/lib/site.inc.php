<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/11
 * Time: 2:23 PM
 */
require __DIR__ . "/../vendor/autoload.php";
$site = new Felis\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}
// Start the session system
session_start();
$user = null;
if(isset($_SESSION[Felis\User::SESSION_NAME])) {
    $user = $_SESSION[Felis\User::SESSION_NAME];
}
// redirect if user is not logged in
if(!isset($open) && $user === null) {
    $root = $site->getRoot();
    header("location: $root/");
    exit;
}
