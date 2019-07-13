<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 11:41 PM
 */
require '../lib/site.inc.php';
$controller = new Felis\CaseController($site, $_POST);
header("location:". $controller->getRedirect());