<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 1:31 AM
 */
require '../lib/site.inc.php';
$controller = new Felis\DeleteCaseController($site, $_POST);
header("location:" . $controller->getRedirect());