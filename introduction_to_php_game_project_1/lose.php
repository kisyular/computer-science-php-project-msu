<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Wumpus Killed You</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="headings">
        <?php echo present_header("Stalking the Wumpus"); ?>
    </div>
    <div class="main-body">
        <figure>
            <img src="wumpus-wins.jpg" alt="Picture of a cat eating brain">
        </figure>
        <div id="text">
            <p class="first">You died and the Wumpus ate your brain!</p>
            <div class="links">
                <p><a href="welcome.php">New Game</a></p>
            </div>
        </div>
    </div>
</body>
</html>