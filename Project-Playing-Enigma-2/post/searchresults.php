<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/21
 * Time: 9:30 AM
 */
require '../lib/enigma.inc.php';
$controller = new Enigma\SearchResultsController($site, $_POST, $_SESSION);
header("location:".$controller->getRedirect());
exit;