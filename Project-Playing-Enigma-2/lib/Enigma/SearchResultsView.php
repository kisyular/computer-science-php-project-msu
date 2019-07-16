<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 9:25 PM
 */

namespace Enigma;


class SearchResultsView
{
    public function __construct(Site $site, array &$session){
        $this->results = $session['results'];
    }
    public function present(){
        $html=<<<HTML
<form action="post/searchresults.php" method="post" class="results">
<div class="form-div">
<div class="form-box">
<table>
		<tr>
			<th>&nbsp;</th>
			<th>Name</th>
		</tr>
HTML;
        foreach($this->results as $user){
            $name = $user->getName();
            $id = $user->getId();
            $html.=<<<HTML
<tr>
	<td><input type="radio" name="user" value=$id></td>
	<td>$name</td>
</tr>
HTML;
        }
        $html.=<<<HTML
	</table>
	<p><input type="submit" value="Add" name="add"></p>
	<p><input type="submit" value="Cancel" name="cancel"></p>
</div>
</div>
</form>
HTML;
        return $html;
    }
    private $results;
}