<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 8:49 PM
 */
require '../lib/site.inc.php';
$controller = new Felis\CasesController($site, $_POST);
header("location:" . $controller->getRedirect());