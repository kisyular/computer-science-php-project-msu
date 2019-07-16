<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 2:37 PM
 */

namespace Enigma;


class IndexView
{
    public function __construct(Site $site, array $get){
        $this->site = $site;
        if(isset($get['e'])){
            switch (intval($get['e'])){
                case self::INVALID_EMAIL:
                    $this->error = "Invalid credentials";
                    break;
                case self::INVALID_PASSWORD:
                    $this->error = "Invalid password";
                    break;
                default:
                    $this->error = "Invalid Credentials";
            }
        }
    }
    public function present(){
        $root = $this->site->getRoot();
        $html =<<<HTML
    <div class="welcome">
            <h1>Welcome to Amanuel's Endless Enigma!</h1>
    </div>
    <div class="form-div">
        <div class="form-box">
                    <form method="post" action="post/index-post.php">
                    <p><label for="first">Email</label></p>
                    <p><input id="first" type="text" name="email"></p>
                    <p><label for="second">Password</label></p>
                    <p><input id="second" type="password" name="password"></p>
                    <p><input type="submit" value="Login" name="login"></p>
                    <p><a href="$root/newuser.php" id="newuser">New User</a></p>
            
                
HTML;
        if($this->error){
            $html.= "<p class=\"error-message\">$this->error</p>";
        }
        $html.=<<<HTML
                </form>
        </div>
    </div>
HTML;
        return $html;

    }
    private $error = null;
    private $site;
    const INVALID_EMAIL = 1;
    const INVALID_PASSWORD = 2;

}