<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 6:55 PM
 */

namespace Enigma;


class SendView extends CommunicateView
{
    public function __construct(Site $site, System $system, array $get, array &$session)
    {
        parent::__construct($site, $system, $get);
        $this->session = $session;
    }
    public function present(){
        $code = $this->system->getCode();
        $html=<<<HTML
<form class="comm" method="post" action="post/send.php">
<div class="form-div search">
        <div class="form-box">
        <p>Find Recipients: <input type="text" placeholder="Search..." name="searchVal"> <input type="submit" value="Search" name="search"></p>
HTML;
        if(isset($this->session['choice'])){
            foreach($this->session['choice'] as $user){
                $name = $user->getName();
                $id = $user->getId();
                $html.=<<<HTML
<p><button value=$id name="remove">Remove</button>   $name</p>
HTML;
            }
            $html.="</div></div>";
        } else {
            $html.="<p>Use search to find recipients for a message to send.</p></div></div>";
        }

        $html.=<<<HTML
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
        $html.=<<<HTML
<div class="form-div batching">
        <div class="form-box">
        <p>Code: <input type="text" name="code" value=$code></p>
<div class="text-area">
HTML;
        $html.=$this->presentTextArea();
        $html.="</div>";
        $userid = $this->system->getUser()->getId();
        $html.=<<<HTML
<input type="hidden" value=$userid name="userid">
<p><input type="submit" value="Encode ->" name="encode"></p>
                    <p><input type="submit" value="Send" name="send"></p>
HTML;
        if($this->error===CommunicateController::NO_CODE){
            $html.="<p class=\"error-message\">please provide a valid code</p>";
        }
        if($this->error===SendController::NO_RECIPIENTS){
            $html.="<p class=\"error-message\">please specify recipients</p>";
        }
        if($this->error===SendController::EMPTY_MESSAGE){
            $html.="<p class=\"error-message\">please provide a message and encode</p>";
        }

        $html.="</div></div></form>";
        return $html;

    }
    private $session;

}