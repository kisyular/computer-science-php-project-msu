<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 9:50 PM
 */

namespace Enigma;


class SearchResultsController
{
    public function __construct(Site $site, array $post, array &$session)
    {
        $root = $site->getRoot();
        if(isset($post['add'])){
            unset($session['results']);
            $users = new Users($site);
            $user = $users->getById($post['user']);
            if(isset($session['choice'])){
                $session['choice'][]=$user;
            } else {
                $session['choice'] = [$user];
            }
            $this->redirect = "$root/send.php";
        } else {
            $this->redirect = "$root/send.php";
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