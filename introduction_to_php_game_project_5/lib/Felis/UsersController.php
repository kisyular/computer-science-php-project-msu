<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 4:38 AM
 */

namespace Felis;


class UsersController
{
    public function __construct(Site $site, User $user, array $post) {
        $root = $site->getRoot();
        if(isset($post['add'])){
            $this->redirect = "$root/user.php";
        } else if(isset($post['edit'])){
            if(isset($post['user'])){
                $id = $post['user'];
                $this->redirect = "$root/user.php?id=$id";
            } else {
                $this->redirect = "$root/users.php?e=". self::SELECT_USER;
            }
        }

    }

    /**
     * @return mixed
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
    const SELECT_USER = 1;
}