<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 4:38 AM
 */

namespace Felis;


class UsersView extends View
{
    public function __construct(Site $site, array $get)
    {
        $this->setTitle("Felis Investigations Users");
        $this->addLink("staff.php", "Staff");
        $this->addLink("post/logout.php", "Log out");
        $this->site = $site;
        if(isset($get['e'])){
            $this->error = intval($get['e']);
        }
    }
    public function present(){
        $users = new Users($this->site);
        $list = $users->getUsers();
        $html =<<<HTML
<form class="table" action="post/users.php" method="post">
HTML;
        if($this->error && $this->error === 1){
            $html.="<p>Select a user to edit</p>";
        }
        $html.=<<<HTML
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="edit" id="edit" value="Edit">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>

	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
HTML;

        foreach($list as $user){
            $name = $user->getName();
            $email = $user->getEmail();
            $role = $user->getRole()===User::ADMIN ? 'Admin' : ($user->getRole()===User::CLIENT ? 'Client' : 'Staff');
            $id = $user->getId();
            $html.=<<<HTML
<tr>
	<td><input type="radio" name="user" value=$id></td>
	<td>$name</td>
	<td>$email</td>
	<td>$role</td>
</tr>
HTML;
        }

        $html.=<<<HTML
	</table>
</form>
HTML;
        return $html;
    }
    private $site;
    private $error = null;
}