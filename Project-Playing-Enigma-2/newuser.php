<?php
$open = true;
require 'lib/enigma.inc.php';

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
        <div class="form-div" id="create">
            <div class="form-box">
                <p>Creating account on the Endless Enigma will allow you to send and receive messages.</p>
                <form method="post" action="post/newuser-post.php">
                    <p><label for="first">Name</label></p>
                    <p><input id="first" type="text" name="name"></p>
                    <p><label for="second">Email</label></p>
                    <p><input id="second" type="text" name="email"></p>
                    <p><input type="submit" value="Create Account" name="create"></p>
                    <p><input type="submit" value="Cancel" name="cancel" id="cancel"></p>
                </form>
                <p>By creating account on The Endless Enigma, You have granted permission for others to
                    view your name as you have provided it. You arenot required to use your real name in The Endless Enigma,
                    you may use a pseudonym if you wish. The email address you enter must be valid, but will not be disclosed
                    to users of the system.</p>
                <p>Offensive pseudonyms or message content are strictly prohibited.</p>
            </div>
        </div>
        <footer>
            <figure><img src="banner1-800.png" alt="Another picture of enigma"></figure>
        </footer>
</body>
</html>