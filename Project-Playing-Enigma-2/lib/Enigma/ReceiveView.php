<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 6:55 PM
 */

namespace Enigma;


class ReceiveView extends CommunicateView
{
    public function __construct(Site $site, System $system, array $get)
    {
        parent::__construct($site, $system, $get);
        if(isset($get['v'])){
            $this->view = intval($get['v']);
        }
    }
    public function present(){
        $messages = new Messages($this->site);
        $html=<<<HTML
<form class="comm" method="post" action="post/receive.php">
<div class="form-div">
        <div class="form-box">
HTML;
        $html.=$this->rotorOptions('1');
        $html.=$this->rotorOptions('2');
        $html.=$this->rotorOptions('3');
        $html.=<<<HTML
<div id='settings-form'>
                    <p><input type="submit" value="Set" name="set"></p>
                    <p><input type="submit" value="Clear" name="clear"></p>
                </div>
HTML;
        if($this->error===CommunicateController::SETTING_ERROR){
            $html.="<p class=\"error-message\">Invalid rotor settings</p>";
        }
        $html.="</div></div>";
        if($this->view){
            $viewMessage = $messages->getById($this->view);
            $mstring = $viewMessage->getMessage();
            $mcode = $viewMessage->getCode();
            $this->system->useCode($mcode);
            $decodedMessage = $this->system->decodeBatch($mstring);
            $html.=<<<HTML
<div class="form-div messages">
        <div class="form-box">
        <p>Code: <input type="text" name="code" value=$mcode></p>
<div class="text-area">
<textarea name=\"plain\" cols=\"30\" rows=\"10\">$decodedMessage</textarea>
<textarea name=\"encoded\" cols=\"30\" rows=\"10\">$mstring</textarea>
</div>
</div>
</div>
HTML;
        }
        $html.=<<<HTML
<div class="form-div senderlist">
        <div class="form-box">
        <table>
		<tr>
			<th>Select</th>
			<th>Time</th>
			<th>Sender</th>
		</tr>
HTML;


        $received = $messages->recievedMessages($this->system->getUser()->getId());
        $users = new Users($this->site);
        foreach($received as $message) {
            $id = $message->getId();
            $date = $message->getDate();
            $sender = $users->getById($message->getSenderid())->getName();
            $html .= <<<HTML
<tr>
    <td><input type="radio" value=$id name="re-message"></td>
    <td>$date</td>
    <td>$sender</td>
</tr>
HTML;
        }
        $html.=<<<HTML
</table>
<p><input type="submit" value="View" name="viewMessage"></p>
HTML;
        if($this->error===ReceiveController::SELECT_MESSAGE){
            $html.="<p class=\"error-message\">Select a message to view</p>";
        }
        $html.=<<<HTML
</div></div></form>
HTML;
        return $html;
    }
    private $view = null;

}