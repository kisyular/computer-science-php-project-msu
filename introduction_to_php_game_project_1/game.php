<?php
require 'format.inc.php';
require 'wumpus.inc.php';
$room = 1; // The room we are in.
$birds = 7;  // Room with the birds
$wumpus = 16; //where wumpus is
$cave = cave_array(); // Get the cave
$pits = array(3, 10, 13);    // Rooms with a bottomless pit
if(isset($_GET['r'])&& isset($cave[$_GET['r']]) ) {
    // We have been passed a room number
    $room = $_GET['r'];
}
if(isset($_GET['a'])&& isset($cave[$_GET['a']]) ) {
    // We have been passed a room number
    if($_GET['a'] == $wumpus) {
        header("Location: win.php");
        exit;
    }
}
if($room == 7){
    $room = 10;
}
if(in_array($room,$pits) || $room == $wumpus ){
    header("Location: lose.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stalking the Wumpus</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>

    <div class="headings">
        <?php echo present_header("Stalking the Wumpus"); ?>
    </div>
    <div class="main-body">
        <figure>
            <img src="cave.jpg" alt="Picture of cave">
        </figure>
        <div id="text">
            <?php
            echo '<p>' . date("g:ia l, F j, Y") . '</p>';
            ?>
            <p class="first">You are in room <?php echo $room; ?></p>
            <p><?php if(in_array($birds, $cave[$room],true)){
                    echo "You hear birds!";
                } else {
                    echo "&nbsp;";
                }?></p>
            <p><?php
                if(array_intersect($pits,$cave[$room])){
                    echo "You feel a draft!";
                } else {
                    echo "&nbsp;";
                }?></p>
            <p><?php
                function check_wumpus($number, $arr , $count=0){
                    global $cave, $wumpus, $room;
                    $count++;
                    if(!in_array($wumpus, $arr )){
                        if ($count >= 2){
                            return false;
                        } else {
                            if ($arr[$number] == $room) {
                                return false;
                            } else {
                                return check_wumpus($number, $cave[$arr[$number]], $count);
                            }
                        }
                    } else {
                        return true;
                    }
                }
                if (check_wumpus(0,$cave[$room]) || check_wumpus(1,$cave[$room]) || check_wumpus(2,$cave[$room])) {
                    echo "You smell a wumpus!";
                } else{
                    echo "&nbsp;";
                }?></p>
        </div>
        <div id="rooms">
            <div class="room">
                <p><img src="cave2.jpg" alt="picture of cave"></p>
                <p><a href="game.php?r=<?php echo $cave[$room][0]; ?>"><?php echo $cave[$room][0]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][0]; ?>">Shoot Arrow</a></p>
            </div>
            <div class="room">
                <p><img src="cave2.jpg" alt="picture of cave"></p>
                <p><a href="game.php?r=<?php echo $cave[$room][1]; ?>"><?php echo $cave[$room][1]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][1]; ?>">Shoot Arrow</a></p>
            </div>
            <div class="room">
                <p><img src="cave2.jpg" alt="picture of cave"></p>
                <p><a href="game.php?r=<?php echo $cave[$room][2]; ?>"><?php echo $cave[$room][2]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][2]; ?>">Shoot Arrow</a></p>
            </div>
        </div>
        <div class="footer">
            <p>You have three arrows remaining</p>
        </div>
    </div>
</body>
</html>