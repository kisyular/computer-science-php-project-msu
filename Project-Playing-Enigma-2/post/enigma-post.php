<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 2:07 AM
 */
require '../lib/enigma.inc.php';
$controller = new Enigma\EnigmaController($site, $system, $_POST);
$root = $site->getRoot();
header("location:$root/enigma.php");
exit;