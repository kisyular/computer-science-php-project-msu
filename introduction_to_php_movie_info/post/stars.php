<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/26
 * Time: 2:07 PM
 */
require '../lib/site.inc.php';

$controller = new Noir\StarController($site, $user, $_POST);
echo $controller->getResult();
