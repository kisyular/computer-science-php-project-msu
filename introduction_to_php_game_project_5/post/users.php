<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 4:46 AM
 */
require '../lib/site.inc.php';

$controller = new Felis\UsersController($site, $user, $_POST);
header("location: " . $controller->getRedirect());