<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 1:31 AM
 */

namespace Felis;


class DeleteCaseController
{
    public function __construct(Site $site, array $post)
    {
        $root = $site->getRoot();
        if(isset($post['yes'])){
            $cases = new Cases($site);
            $cases->delete($post['id']);
        }
        $this->redirect = "$root/cases.php";
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