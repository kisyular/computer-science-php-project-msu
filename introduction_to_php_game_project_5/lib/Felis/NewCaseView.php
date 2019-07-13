<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 9:15 PM
 */

namespace Felis;


class NewCaseView extends View
{
    public function __construct(Site $site){
        $this->setTitle("Felis Cases");
        $this->addLink("staff.php", "Staff");
        $this->addLink("cases.php", "Cases");
        $this->addLink("post/logout.php", "Log out");
        $this->site = $site;
    }
    public function present() {
        $html = <<<HTML
<form action="post/newcase.php" method="post">
	<fieldset>
		<legend>New Case</legend>
		<p>Client:
			<select name="client">
HTML;
        $users = new Users($this->site);
        $clients = $users->getClients();
        foreach($clients as $client) {
            $id = $client['id'];
            $name = $client['name'];
            $html .= '<option value="' . $id . '">' . $name . '</option>';
        }
        $html .= <<<HTML
			</select>
		</p>

		<p>
			<label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="Case Number">
		</p>

		<p><input type="submit" value="OK" name="ok"> <input type="submit" value="Cancel" name="cancel"></p>

	</fieldset>
</form>
HTML;

        return $html;
    }
    private $site;	///< The Site object


}