<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 10:45 AM
 */
$open = true;
require '../lib/enigma.inc.php';

//if(!isset($_POST['user']) || empty($_POST['user'])){
//    $_SESSION['message'] = "Enter a valid username!";
//    header("location:index.php");
//    exit;
//}
$controller = new Enigma\IndexController($site, $_SESSION, $_POST);
//echo isset($_SESSION[Enigma\User::USER_SESSION]);
//print_r($_POST);

header("location:". $controller->getRedirect());
exit;