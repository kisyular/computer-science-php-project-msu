<?php
/**
 * Created by PhpStorm.
 * User: Rellika Kisyula
 * Date: 2018/06/10
 * Time: 10:35 PM
 */
require __DIR__ . "/vendor/autoload.php";
require 'lib/enigma.inc.php';
$controller = new Enigma\BatchController($system, $_POST);
$controller->handleBatch();
header("location:batch.php");