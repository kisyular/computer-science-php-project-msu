<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Stalking the Wumpus</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="headings">
        <?php echo present_header("Stalking the Wumpus"); ?>
    </div>
    <div class="main-body">
        <figure>
            <img src="cave-evil-cat.png" alt="Picture of a cat">
        </figure>
        <div id="text">
            <p class="first">Welcome to <span class="welcome">Stalking the Wumpus</span></p>
            <div class="links">
                <p><a href="instructions.php">Instructions</a></p>
                <p><a href="game.php">Start Game</a></p>
            </div>
        </div>
    </div>

</body>
</html>