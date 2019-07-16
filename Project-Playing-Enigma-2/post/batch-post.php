<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/10
 * Time: 10:35 PM
 */
require '../lib/enigma.inc.php';
$controller = new Enigma\BatchController($site, $system, $_POST);
$root = $site->getRoot();
header("location:$root/batch.php");