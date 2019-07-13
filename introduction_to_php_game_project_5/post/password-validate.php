<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 6:09 AM
 */
$open = true;
require '../lib/site.inc.php';
$controller = new Felis\PasswordValidateController($site, $_POST);
header("location:". $controller->getRedirect());