<?php
require_once "../lib/enigma.inc.php";
$controller = new \Enigma\EnigmaController($system, $_POST);
//echo json_encode($_POST);
echo $controller->getResult();
//echo $controller->showRedirect();
//header("location: " . $controller->getRedirect());