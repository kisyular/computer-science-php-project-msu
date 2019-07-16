<?php
/**
 * Created by PhpStorm.
 * User: Rellika Kisyula
 * Date: 2018/06/10
 * Time: 8:09 PM
 */
require __DIR__ . "/vendor/autoload.php";
require 'lib/enigma.inc.php';
$controller = new Enigma\SettingsController($system, $_POST);
$controller->handleSet($_SESSION['setting_message']);
header("location:".$controller->getPage());