<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 11:40 PM
 */

namespace Felis;


class CaseView extends View
{
    public function __construct(Site $site, array $get)
    {
        $this->setTitle("Felis Case");
        $this->addLink("staff.php", "Staff");
        $this->addLink("cases.php", "Cases");
        $this->addLink("post/logout.php", "Log out");
        $this->site = $site;
        if(isset($get['id'])){
            $cases = new Cases($site);
            $this->case = $cases->get($get['id']);
        }
    }
    public function present(){
        $clientName = $this->case->getClientName();
        $number = $this->case->getNumber();
        $summary = $this->case->getSummary();
        $users = new Users($this->site);
        $agents = $users->getAgents();
        $id = $this->case->getId();
        $html =<<<HTML
<form method="post" action="post/case.php">
	<fieldset>
	    <input type="hidden" name="id" value="$id">
		<legend>Case</legend>
		<p>Client: $clientName</p>

		<p>
			<label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="Case Number"
				   value=$number>
		</p>
		<p>
			<label for="summary">Summary</label><br>
			<input type="text" id="summary" name="summary" placeholder="Summary"
				   value=$summary>
		</p>

		<p>
			<label for="agent">Agent in Charge: </label>
			<select id="agent" name="agent">
HTML;
		foreach($agents as $agent){
		    $name = $agent->getName();
		    $id = $agent->getId();
		    if($name !== $this->case->getAgentName()){
                $html.="<option value=$id>$name</option>";
            } else {
                $html.="<option value=$id selected>$name</option>";
            }
        }
        $html.=<<<HTML
			</select>
		</p>

		<p>
			<label for="status">Status: </label>
			<select id="status" name="status">
HTML;
        if($this->case->getStatus()=== ClientCase::STATUS_OPEN){
            $html.= "<option selected value='O'>Open</option>";
            $html.= "<option value='C'>Closed</option>";
        } else {
            $html.="<option selected value='C'>Closed</option>";
            $html.= "<option value='O'>Open</option>";
        }
		$html.=<<<HTML
			</select>
		</p>
		<p>
			<input type="submit" value="Update" name="update"> <input type="submit" value="Cancel" name="cancel">
		</p>

		<div class="notes">
		<h2>Notes</h2>

		<div class="timelist">
			<div class="report">
				<div class="info">
					<p class="time">2/10/2016 11:35am</p>
					<p class="agent">Martin, Harvey</p>
				</div>
				<p>Initial meeting with client. He's very concerned
					Felix will just not shut up at night. It's not like him to caterwaul so much, so there
					must be something going on in the neighborhood.</p>

			</div>

			<div class="report">
				<div class="info">
					<p class="time">2/14/2016 2:15pm</p>
					<p class="agent">Martin, Harvey</p>
				</div>
				<p>Met with the client to discuss the case.</p>
			</div>
		</div>

		<p>
			<label for="note">Notes</label><br>
			<textarea id="note" name="note" placeholder="Note"></textarea>
		</p>
		<p>
			<input type="submit" value="Add Note">
		</p>
		</div>

		<div class="reports">
			<h2>Reports</h2>

			<div class="timelist">
				<div class="report">
					<div class="info">
						<p class="time"><a href="report.php">2/12/2016 1:35am</a></p>
						<p class="agent">Martin, Harvey</p>
					</div>
					<p>Surveillance of neighborhood for three hours. Nothing untoward spotted.</p>

				</div>
			</div>

			<div class="timelist">
				<div class="report">
					<div class="info">
						<p class="time"><a href="report.php">2/13/2016 2:15am</a></p>
						<p class="agent">Martin, Harvey</p>
					</div>
					<p>Surveillance of neighborhood for two hours. Spotted a very attractive
						Siamese cat wandering though. Caterwauling commenced.</p>

				</div>
			</div>

			<p>
				<input type="submit" value="Add Report">
			</p>
		</div>

	</fieldset>
</form>
HTML;
        return $html;
    }
    private $site;
    private $case;
}