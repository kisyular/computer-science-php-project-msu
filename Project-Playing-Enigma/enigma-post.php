<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 2:07 AM
 */
require __DIR__ . "/vendor/autoload.php";
require 'lib/enigma.inc.php';
$controller = new Enigma\EnigmaController($system, $_POST);
$controller->handleClick();

header("location:enigma.php");
exit;