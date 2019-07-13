<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/12
 * Time: 10:21 PM
 */
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

If(isset($_SESSION[Felis\User::SESSION_NAME])){
    unset($_SESSION[Felis\User::SESSION_NAME]);
}
$root = $site->getRoot();
header("location:$root/");