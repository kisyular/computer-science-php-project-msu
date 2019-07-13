<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/12
 * Time: 10:29 PM
 */

namespace Felis;


class LoginView extends View
{
    public function __construct($session,$get)
    {
        if(isset($get['e'])){
            $this->error = true;
        }
        $this->session = $session;
    }
    public function presentForm(){
        $html= <<<HTML
<form method="post" action="post/login.php">
	<fieldset>
		<legend>Login</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password</label><br>
			<input type="password" id="password" name="password" placeholder="Password">
		</p>
		<p>
			<input type="submit" value="Log in"> <a href="">Lost Password</a>
		</p>
HTML;
        if($this->error){
            $msg = $this->session['error'];
            $html.="<p>$msg</p>";
        }
        $html.="<p><a href=\"./\">Felis Agency Home</a></p></fieldset></form>";
        return $html;

    }
    private $error=false;
    private $session;
}