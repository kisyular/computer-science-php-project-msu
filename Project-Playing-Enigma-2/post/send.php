<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 8:41 PM
 */
require '../lib/enigma.inc.php';
$controller = new Enigma\SendController($site, $system, $_POST, $_SESSION);
header("location:".$controller->getRedirect());
exit;