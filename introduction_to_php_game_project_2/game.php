<?php
    require 'format.inc.php';
    require 'lib/game.inc.php';
    $view = new Wumpus\WumpusView($wumpus);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stalking the Wumpus</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="headings">
        <p><a href="welcome.php">New Game</a> <a href="game.php">Game</a> <a href="instructions.php">Instructions</a></p>
        <h1>Stalking the Wumpus</h1>
    </div>
    <div class="main-body">
        <figure>
            <img src="cave.jpg" alt="Picture of cave">
        </figure>
        <div id="text">
            <?php
            echo $view->presentStatus();
            ?>
        </div>
        <div id="rooms">
            <?php
            echo $view->presentRoom(0);
            echo $view->presentRoom(1);
            echo $view->presentRoom(2);
            ?>
        </div>
        <div class="footer">
            <?php
            echo $view->presentArrows();
            ?>
        </div>
    </div>
</body>
</html>