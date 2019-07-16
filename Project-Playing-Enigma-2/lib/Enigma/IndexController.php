<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/08
 * Time: 2:37 PM
 */

namespace Enigma;


class IndexController
{
    public function __construct(Site $site, array &$session, array $post){
        $root = $site->getRoot();
        if(isset($post['login'])){
            $users = new Users($site);
            $email = strip_tags($post['email']);
            $password = strip_tags($post['password']);
            $user = $users->login($email, $password);
            if($user === null) {
                // Login failed
                $this->redirect = "$root/index.php?e=".IndexView::INVALID_EMAIL;
            } else {
                $session[User::USER_SESSION] = new System($user);
                $this->redirect = "$root/enigma.php";
            }
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    private $redirect;  ///< Page we will redirect the user to.
}