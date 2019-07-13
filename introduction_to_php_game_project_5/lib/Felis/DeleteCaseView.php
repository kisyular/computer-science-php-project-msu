<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 1:23 AM
 */

namespace Felis;


class DeleteCaseView extends View
{
    public function __construct(Site $site, array $get)
    {
        $this->site = $site;
        $cases = new Cases($site);
        $this->case = $cases->get($get['id']);
    }
    public function present(){
        $number = $this->case->getNumber();
        $id = $this->case->getId();
        $html=<<<HTML
<form action="post/deleteCase.php" method="post">
	<fieldset>
	    <input type="hidden" name="id" value="$id">
		<legend>Delete?</legend>
		<p>Are you sure absolutely certain beyond a shadow of
			a doubt that you want to delete case $number?</p>

		<p>Speak now or forever hold your peace.</p>

		<p><input type="submit" name="yes" value="Yes"> <input type="submit" name="no" value="No"></p>

	</fieldset>
</form>
HTML;
        return $html;
    }
    private $site;
    private $case;
}