<?php
$open = true;
require 'lib/enigma.inc.php';
$view = new Enigma\IndexView($site, $_GET);
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
    </header>
    <?php
        echo $view->present();
    ?>
    <footer>
        <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
    </footer>
</body>
</html>