<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 10:45 AM
 */
require __DIR__ . "/vendor/autoload.php";
require 'lib/enigma.inc.php';

//if(!isset($_POST['user']) || empty($_POST['user'])){
//    $_SESSION['message'] = "Enter a valid username!";
//    header("location:index.php");
//    exit;
//}
$controller = new Enigma\IndexController($system, $_POST);
$controller->handlePost($_SESSION['message']);
//$user = strip_tags($_POST['user']);
//if(!$system->getUsername()){
//    $system->setUsername($user);
//}
//if(isset($_SESSION['message'])){
//    unset($_SESSION['message']);
//}
header("location:". $controller->getPage());
exit;