<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 8:09 PM
 */
require '../lib/enigma.inc.php';
$controller = new Enigma\SettingsController($site, $system, $_POST);
//print_r($_POST);
header("location:".$controller->getRedirect());
exit;