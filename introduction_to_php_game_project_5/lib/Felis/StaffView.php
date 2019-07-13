<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/12
 * Time: 2:56 PM
 */

namespace Felis;


class StaffView extends View
{
    public function __construct(){
        $this->setTitle("Felis Staff");
        $this->addLink("post/logout.php", "Log out");
    }

}