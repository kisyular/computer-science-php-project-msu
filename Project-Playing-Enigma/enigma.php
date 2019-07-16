<?php
require 'lib/enigma.inc.php';
$view = new Enigma\EnigmaView($system);
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
            <p><a class="current-link" href="enigma.php">Enigma</a></p>
            <p><a href="settings.php">Settings</a></p>
            <p><a href="batch.php">Batch</a></p>
            <p><a href="logout.php">Ausloggen</a></p>
        </nav>
    </header>

        <?php
            echo $view->welcome();
        ?>
        <div class="form-div-enigma">

            <form action="enigma-post.php" method="post">
                <div class="enigma">

                    <img src="enigma.png" alt="Picture of enigma">
<!--                    <p class="rotor-key key-A1">A</p>-->
<!--                    <p class="rotor-key key-A2">A</p>-->
<!--                    <p class="rotor-key key-A3">A</p>-->
                    <?php
                        $view->presentForm();
                    ?>

                    <!--                <p class="key key-q2">Q</p>-->
                    <!--                <p class="key key-w2">W</p>-->
                    <!--                <p class="key key-e2">E</p>-->
                    <!--                <p class="key key-r2">R</p>-->
                    <!--                <p class="key key-t2">T</p>-->
                    <!--                <p class="key key-z2">Z</p>-->
                    <!--                <p class="key key-u2">U</p>-->
                    <!--                <p class="key key-i2">I</p>-->
                    <!--                <p class="key key-o2">O</p>-->
                    <!--                <p class="key key-a2">A</p>-->
                    <!--                <p class="key key-s2">S</p>-->
                    <!--                <p class="key key-d2">D</p>-->
                    <!--                <p class="key key-f2">F</p>-->
                    <!--                <p class="key key-g2">G</p>-->
                    <!--                <p class="key key-h2">H</p>-->
                    <!--                <p class="key key-j2">J</p>-->
                    <!--                <p class="key key-k2">K</p>-->
                    <!--                <p class="key key-p2">P</p>-->
                    <!--                <p class="key key-y2">Y</p>-->
                    <!--                <p class="key key-x2">X</p>-->
                    <!--                <p class="key key-c2">C</p>-->
                    <!--                <p class="key key-v2">V</p>-->
                    <!--                <p class="key key-b2">B</p>-->
                    <!--                <p class="key key-n2">N</p>-->
                    <!--                <p class="key key-m2">M</p>-->
                    <!--                <p class="key key-l2">L</p>-->


                </div>
            </form>
            <!--<figure class="rotor"><img src="rotors.png" alt="picture of rotor"></figure>-->

            <div class="form-box">
                <form action="enigma-post.php" method="post">
                    <p><input type="submit" name="reset" value="Reset"></p>
                </form>
            </div>
        </div>

    <footer>
        <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
    </footer>
</body>
</html>