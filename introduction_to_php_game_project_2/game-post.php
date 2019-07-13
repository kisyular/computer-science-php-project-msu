<?php
/**
 * Created by PhpStorm.
 * User: Rellika Kisyula
 * Date: 2018/05/29
 * Time: 1:08 PM
 */
//phpinfo();
require 'lib/game.inc.php';
$controller = new Wumpus\WumpusController($wumpus, $_GET);
if($controller->isReset()) {
    unset($_SESSION[WUMPUS_SESSION]);
}
if($controller->isCheatMode()) {
    unset($_SESSION[WUMPUS_SESSION]);
    $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus(1422668587);   // Seed: 1422668587

}

header('Location: ' . $controller->getPage());
