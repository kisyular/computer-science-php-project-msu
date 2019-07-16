<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 2:31 AM
 */
$open = true;
require '../lib/enigma.inc.php';
$controller = new Enigma\PasswordValidateController($site,$_POST);
header("location:". $controller->getRedirect());
exit;