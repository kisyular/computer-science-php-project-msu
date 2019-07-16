<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 3:25 PM
 */
require '../lib/enigma.inc.php';

if(isset($_SESSION[Enigma\User::USER_SESSION])){
    unset($_SESSION[Enigma\User::USER_SESSION]);
}
$root = $site->getRoot();
header("location:$root");
exit;