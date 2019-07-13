<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>You Killed the Wumpus</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="headings">
        <?php echo present_header("Stalking the Wumpus"); ?>
    </div>
    <div class="main-body">
        <figure>
            <img src="dead-wumpus.jpg" alt="Picture of a dead cat">
        </figure>
        <div id="text">
            <p class="first">You Killed the Wumpus</p>
            <div class="links">
                <p><a href="welcome.php">New Game</a></p>
            </div>
        </div>
    </div>
</body>
</html>