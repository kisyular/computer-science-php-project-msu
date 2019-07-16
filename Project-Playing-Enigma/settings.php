<?php
require 'lib/enigma.inc.php';
$view = new Enigma\SettingsView($system);
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
        <p><a class="current-link" href="settings.php">Settings</a></p>
        <p><a href="batch.php">Batch</a></p>
        <p><a href="logout.php">Ausloggen</a></p>
    </nav>
</header>

<div class="form-div-batch">
        <div class="enigma">
            <img src="rotors.png" alt="Picture of rotors">
            <?php
                $view->presentRotors();
            ?>
<!--            <p class="key key-A1">A</p>-->
<!--            <p class="key key-A2">A</p>-->
<!--            <p class="key key-A3">A</p>-->
        </div>

        <div class="form-box-settings">
            <form method="post" action="settings-post.php">
                <?php
                    echo $view->rotorOptions('1');
                    echo $view->rotorOptions('2');
                    echo $view->rotorOptions('3');
                ?>
<!--                <div class="options">-->
<!--                    <p> Rotor 1: <select name="rotor1">-->
<!--                        <option value="1">I</option>-->
<!--                        <option value="2">II</option>-->
<!--                        <option value="3">III</option>-->
<!--                        <option value="4">IV</option>-->
<!--                        <option value="5">V</option>-->
<!--                    </select></p>-->
<!--                    <p>Setting: <input type="text" id="rotor1-setting" value="A" name="setting1"></p>-->
<!--                </div>-->
<!--                <div class="options">-->
<!--                    <p> Rotor 2: <select name="rotor2">-->
<!--                        <option value="1">I</option>-->
<!--                        <option value="2" selected>II</option>-->
<!--                        <option value="3">III</option>-->
<!--                        <option value="4">IV</option>-->
<!--                        <option value="5">V</option>-->
<!--                    </select></p>-->
<!--                    <p>Setting: <input type="text" id="rotor2-setting" value="A" name="setting2"></p>-->
<!--                </div>-->
<!--                <div class="options">-->
<!--                    <p> Rotor 3: <select name="rotor3">-->
<!--                        <option value="1">I</option>-->
<!--                        <option value="2">II</option>-->
<!--                        <option value="3" selected>III</option>-->
<!--                        <option value="4">IV</option>-->
<!--                        <option value="5">V</option>-->
<!--                    </select></p>-->
<!--                    <p>Setting: <input id="rotor3-setting" type="text" value="A" name="setting3"></p>-->
<!--                </div>-->
                <div id='settings-form'>
                    <p><input type="submit" value="Set" name="submit"></p>
                    <p><input type="submit" value="Clear" name="submit"></p>
                </div>
                <?php if($setmsg){
                    echo "<p class=\"error-message\">$setting_message</p>";
                }?>
            </form>
        </div>
</div>

<footer>
    <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
</footer>
</body>

</html>