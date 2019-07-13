<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 9:40 PM
 */
require '../lib/site.inc.php';

$controller = new Felis\NewCaseController($site, $user, $_POST);
header("location: " . $controller->getRedirect());