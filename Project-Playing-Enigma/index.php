<?php
require 'lib/enigma.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Endless Enigma</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <figure><img src="banner-800.png" alt="Picture of Enigma"></figure>
    </header>
    <div class="welcome">
            <h1>Welcome to Amanuel's Endless Enigma!</h1>
    </div>
    <div class="form-div">
        <div class="form-box">
                <form method="post" action="index-post.php">
                    <p><label for="first">Name</label></p>
                    <p><input id="first" type="text" name="user"></p>
                    <p><input type="submit" value="Start"></p>
                    <?php if($msg){
                        echo "<p class=\"error-message\">$message</p>";
                    }?>
                </form>
        </div>
    </div>
    <footer>
        <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
    </footer>
</body>
</html>