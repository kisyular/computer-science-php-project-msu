<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 5:53 AM
 */

namespace Felis;


class PasswordValidateView extends View
{
    public function __construct(Site $site, array $get)
    {
        $this->setTitle("Felis Password Entry");
        $this->validator = strip_tags($get['v']);
        if(isset($get['e'])){
            $this->error = intval(strip_tags($get['e']));
        }

    }
    public function present(){
        $html =<<<HTML
<form method="post" action="post/password-validate.php">
        <fieldset>
        	    <input type="hidden" name="validator" value="$this->validator">

        		<legend>Change Password</legend>
        		<p>
        			<label for="email">Email</label><br>
        			<input type="email" id="email" name="email" placeholder="Email">
        		</p>
        		<p>
        			<label for="password">Password:</label><br>
        			<input type="password" id="password" name="password" placeholder="Password">
        		</p>
                <p>
                    <label for="password2">Password (again): </label><br>
                    <input type="password" id="password2" name="password2" placeholder="Password">
                </p>
        		<p>
        			<input type="submit" value="Change" name="change"> <input type="submit" value="Cancel" name="cancel"> 
        		</p>
HTML;
        if($this->error === PasswordValidateController::INVALID_VALIDATOR){
            $html.="<p>Invalid Validator</p>";
        } else if ($this->error === PasswordValidateController::EMAIL_INVALID){
            $html.="<p>Email is invalid</p>";
        } else if($this->error === PasswordValidateController::USER_NOT_EXIST){
            $html.="<p>User doesn't exist</p>";
        } else if($this->error === PasswordValidateController::PASSWORD_NOT_MATCH){
            $html.="<p>Passwords dont match</p>";
        } else if($this->error === PasswordValidateController::PASSWORD_SHORT){
            $html.="<p>Password is too short</p>";
        }
        $html.=<<<HTML
        </fieldset>
</form>
HTML;

        return $html;

    }
    private $error = null;
}