<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 4:38 AM
 */

namespace Felis;


class UserView extends View
{
    public function __construct(Site $site, array $get)
    {
        $this->setTitle("Felis Investigations Users");
        $this->addLink("staff.php", "Staff");
        $this->addLink("users.php", "Users");
        $this->addLink("post/logout.php", "Log out");
        $this->site = $site;
        if(isset($get['id'])){
            $this->editing = true;
            $this->id = intval($get['id']);
        }
    }
    public function present()
    {
        if ($this->editing) {
            $users = new Users($this->site);
            $user = $users->get($this->id);
            $email = $user->getEmail();
            $name = $user->getName();
            $address = $user->getAddress();
            $phone = $user->getPhone();
            $role = $user->getRole();

            $html=<<<HTML
<form action="post/user.php" method="post">
	<fieldset>
		<legend>User</legend>
		<input type="hidden" name="id" value=$this->id>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email" value=$email>
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name" value=$name>
		</p>
		<p>
			<label for="phone">Phone</label><br>
			<input type="text" id="phone" name="phone" placeholder="Phone" value=$phone>
		</p>
		<p>
			<label for="address">Address</label><br>
			<textarea id="address" name="address" placeholder="Address">$address</textarea>
		</p>
		<p>
			<label for="notes">Notes</label><br>
			<textarea id="notes" name="notes" placeholder="Notes"></textarea>
		</p>
		<p>
			<label for="role">Role: </label>
			<select id="role" name="role">
HTML;
            if($role === "A"){
                $html.=<<<HTML
                <option value="admin" selected>Admin</option>
				<option value="staff">Staff</option>
				<option value="client">Client</option>
HTML;
            } else if($role === "S"){
                $html.=<<<HTML
                <option value="admin">Admin</option>
				<option value="staff" selected>Staff</option>
				<option value="client">Client</option>
HTML;
            } else {
                $html.=<<<HTML
                <option value="admin">Admin</option>
				<option value="staff">Staff</option>
				<option value="client" selected>Client</option>
HTML;
            }
            $html.=<<<HTML
			</select>
		</p>
		<p>
			<input type="submit" value="OK" name="ok"> <input type="submit" value="Cancel" name="cancel">
		</p>

	</fieldset>
</form>
HTML;
        } else {
        $html = <<<HTML
<form action="post/user.php" method="post">
	<fieldset>
		<legend>User</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name">
		</p>
		<p>
			<label for="phone">Phone</label><br>
			<input type="text" id="phone" name="phone" placeholder="Phone">
		</p>
		<p>
			<label for="address">Address</label><br>
			<textarea id="address" name="address" placeholder="Address"></textarea>
		</p>
		<p>
			<label for="notes">Notes</label><br>
			<textarea id="notes" name="notes" placeholder="Notes"></textarea>
		</p>
		<p>
			<label for="role">Role: </label>
			<select id="role" name="role">
				<option value="admin">Admin</option>
				<option value="staff">Staff</option>
				<option value="client">Client</option>
			</select>
		</p>
		<p>
			<input type="submit" value="OK" name="ok"> <input type="submit" value="Cancel" name="cancel">
		</p>

	</fieldset>
</form>
HTML;
        }
        return $html;
    }
    private $site;
    private $editing = false;
    private $id = null;
}