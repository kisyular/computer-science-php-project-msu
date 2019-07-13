<?php
/**
 * Created by PhpStorm.
 * User: Rellika Kisyula
 * Date: 2018/06/02
 * Time: 10:25 PM
 */
require 'lib/guessing.inc.php';
$view = new Guessing\GuessingView($guessing);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guessing Game</title>
    <link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<?php echo $view->present(); ?>
</body>
</html>