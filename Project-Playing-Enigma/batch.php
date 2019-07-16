<?php
require 'lib/enigma.inc.php';
$view = new Enigma\BatchView($system);
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
        <nav>
            <p><a href="enigma.php">Enigma</a></p>
            <p><a href="settings.php">Settings</a></p>
            <p><a class="current-link" href="batch.php">Batch</a></p>
            <p><a href="./">Ausloggen</a></p>
        </nav>
    </header>

        <div class="form-div-batch">

            <div class="enigma">
                <img src="rotors.png" alt="Picture of rotors">
                <?php
                    $view->presentRotors();
                ?>
            </div>

            <div class="form-box">

                <form action="batch-post.php" method="post">
                <div class="text-area">
                    <?php
                        $view->presentTextArea();
                    ?>
<!--                    <textarea name="plain" cols="30" rows="5"></textarea>-->
<!--                    <textarea name="encoded" cols="30" rows="5"></textarea>-->
                </div>


                    <p><input type="submit" value="Encode ->" name="submit"></p>
                    <p><input type="submit" value="Decode <-" name="submit"></p>
                    <p><input type="submit" value="Reset" name="submit"></p>
                </form>
            </div>
        </div>
    <footer>
        <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
    </footer>
</body>

</html>