<?php
require 'lib/site.inc.php';
$view = new Felis\UsersView($site, $_GET);
if(!$view->protect($site, $user)) {
    header("location: " . $view->getProtectRedirect());
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="users">
    <?php
    echo $view->header();
    echo $view->present();
    echo $view->footer();
    ?>



    <!--<form class="table">-->
<!--	<p>-->
<!--	<input type="submit" name="add" id="add" value="Add">-->
<!--	<input type="submit" name="edit" id="edit" value="Edit">-->
<!--	<input type="submit" name="delete" id="delete" value="Delete">-->
<!--	</p>-->
<!---->
<!--	<table>-->
<!--		<tr>-->
<!--			<th>&nbsp;</th>-->
<!--			<th>Name</th>-->
<!--			<th>Email</th>-->
<!--			<th>Role</th>-->
<!--		</tr>-->
<!---->
<!--		<tr>-->
<!--			<td><input type="radio" name="user"></td>-->
<!--			<td>Bogart, Humphrey</td>-->
<!--			<td>bogart@felis.com</td>-->
<!--			<td>Admin</td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td><input type="radio" name="user"></td>-->
<!--			<td>Spade, Sam</td>-->
<!--			<td>spade@felis.com</td>-->
<!--			<td>Staff</td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td><input type="radio" name="user"></td>-->
<!--			<td>Bacall, Lauren</td>-->
<!--			<td>bacall@gmail.com</td>-->
<!--			<td>Client</td>-->
<!--		</tr>-->
<!--	</table>-->
<!--</form>-->




</div>

</body>
</html>
