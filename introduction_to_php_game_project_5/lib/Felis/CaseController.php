<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 11:40 PM
 */

namespace Felis;


class CaseController
{
    public function __construct(Site $site, array $post)
    {
        $root = $site->getRoot();
        $id = $post['id'];
        if(isset($post['update'])){
            $number = $post['number'];
            $summary = $post['summary'];
            $agentId = $post['agent'];
            $status = $post['status'];
            $data = array('number'=>$number,'summary'=>$summary,'agent'=>$agentId,'id'=>$id,'agentName'=>'',
                'clientName'=>'','client'=>'', 'status'=>$status);
            $case = new ClientCase($data);
            $cases = new Cases($site);
            if($cases->update($case)){
                $this->redirect = "$root/cases.php";
            } else {
                $this->redirect = "$root/case.php?id=$id";
            };
        } else if(isset($post['cancel'])){
            $this->redirect = "$root/cases.php";
        } else{
            $this->redirect = "$root/case.php?id=$id";
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