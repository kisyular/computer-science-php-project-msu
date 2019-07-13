<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/12
 * Time: 10:17 PM
 */
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

$controller = new Felis\LoginController($site, $_SESSION, $_POST);
header("location: " . $controller->getRedirect());