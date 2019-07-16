<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 1:49 AM
 */

namespace Enigma;


class NewUserController
{
    public function __construct(Site $site, array $post){
        $root = $site->getRoot();
        if(isset($post['create'])){
            $users = new Users($site);
            $name = trim(strip_tags($post['name']));
            $email = trim(strip_tags($post['email']));
            $row = array('id' => null,
                'email' => $email,
                'name' => $name,
                'password' => null,
            );
            $user = new User($row);
            $mailer = new Email();
            $users->sendInvite($user, $mailer);
            $this->redirect = "$root/confirmation.php";
        } else {
            $this->redirect = "$root";
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