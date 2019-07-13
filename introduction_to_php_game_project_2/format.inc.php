<?php
/**
 * Created by PhpStorm.
 * User: Rellika Kisyula
 * Date: 2018/05/24
 * Time: 4:44 PM
 */
function present_header($title) {
    $html = "<header>";
    $html .= "<nav><p><a href=\"welcome.php\">New Game</a> ";
    $html .= "<a href=\"game.php\">Game</a> ";
    $html .= "<a href=\"instructions.php\">Instructions</a></p></nav>";
    $html .= "<h1>$title</h1>";
    $html .= "</header>";

    return $html;
}