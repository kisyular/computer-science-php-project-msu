<?php
$open = true;
require 'lib/enigma.inc.php';
$view = new Enigma\PasswordValidateView($site, $_GET);
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
    <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
</header>
<?php
echo $view->present();
?>
<footer>
    <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
</footer>
</body>
</html>