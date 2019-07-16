<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 8:42 PM
 */
require '../lib/enigma.inc.php';
$controller = new Enigma\ReceiveController($site, $system, $_POST);
header("location:". $controller->getRedirect());
exit;