<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 8:36 PM
 */

namespace Felis;


class CasesController
{
    public function __construct(Site $site, array $post)
    {
        $root = $site->getRoot();
        if(isset($post['add'])){
            $this->redirect = "$root/newcase.php";
        } else if(isset($post['delete']) && isset($post['user'])) {
            $id=$post['user'];
            $this->redirect = "$root/deletecase.php?id=$id";
        } else{
            $this->redirect = "$root/cases.php";
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