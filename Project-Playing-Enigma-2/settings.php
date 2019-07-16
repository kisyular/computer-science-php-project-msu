<?php
require 'lib/enigma.inc.php';
$view = new Enigma\SettingsView($site, $system, $_GET);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Endless Enigma</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <figure><img src="banner-800.png" alt="Picture of Enigma"></figure>
    <nav>
        <p><a href="enigma.php">Enigma</a></p>
        <p><a class="current-link" href="settings.php">Settings</a></p>
        <p><a href="batch.php">Batch</a></p>
        <p><a href="send.php">Send</a></p>
        <p><a href="receive.php">Receive</a></p>
        <p><a href="post/logout.php">Ausloggen</a></p>
    </nav>
</header>

<div class="form-div-batch">
        <div class="enigma">
            <img src="rotors.png" alt="Picture of rotors">
            <?php
                $view->presentRotors();
            ?>
        </div>
    <?php
     echo $view->present();
    ?>

</div>

<footer>
    <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
</footer>
</body>

</html>