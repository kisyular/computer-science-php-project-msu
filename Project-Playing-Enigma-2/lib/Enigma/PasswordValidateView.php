<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 3:07 AM
 */

namespace Enigma;


class PasswordValidateView
{
    public function __construct(Site $site, array $get)
    {
        if(isset($get['v'])){
            $this->validator = $get['v'];
        }
        if(isset($get['e'])){
            $this->error = intval($get['e']);
        }
    }
    public function present(){
        $html=<<<HTML
<div class="form-div" id="create">
    <div class="form-box">
        <form method="post" action="post/password-validate.php">
            <input type="hidden" name="validator" value=$this->validator>
            <p><label for="second">Email</label></p>
            <p><input id="second" type="text" name="email"></p>
            <p><label>Password</label></p>
            <p><input type="password" name="password"></p>
            <p><label>Password (again)</label></p>
            <p><input  type="password" name="password2"></p>
            <p><input type="submit" value="OK" name="addMe"></p>
            <p><input type="submit" value="Cancel" name="cancel"></p>
        </form>
HTML;
        if($this->error){
            switch ($this->error){
                case PasswordValidateController::INVALID_VALIDATOR:
                    $html.="<p>Invalid Validator</p>";
                    break;
                case PasswordValidateController::PASSWORD_NOT_MATCH:
                    $html.="<p>Password don't match</p>";
                    break;
                case PasswordValidateController::PASSWORD_SHORT:
                    $html.="<p>Password too short</p>";
                    break;
                case PasswordValidateController::EMAIL_INVALID:
                    $html.="<p>Email Invalid</p>";
                    break;
            }

        }
        $html.=<<<HTML
    </div>
</div>
HTML;
        return $html;

    }
    private $validator;
    private $error=null;
}