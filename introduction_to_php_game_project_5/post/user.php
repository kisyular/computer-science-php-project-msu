<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 4:54 AM
 */
require '../lib/site.inc.php';

$controller = new Felis\UserController($site, $user, $_POST);
header("location: " . $controller->getRedirect());