<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/26
 * Time: 11:11 AM
 */

namespace Noir;


class StarController extends Controller
{
    /**
     * StarController constructor.
     * @param Site $site Site object
     * @param $user User object
     * @param array $post $_POST
     */
    public function __construct(Site $site, $user, $post) {
        parent::__construct($site);
        $movies = new Movies($site);
        if(isset($post['rating'])){
            if($movies->updateRating($user,$post['id'], $post['rating'])){
                $home = new HomeView($site, $user);

                $this->result = json_encode(array('ok' => true, 'table'=>$home->presentTable(), 'head'=>$home->head()));
            } else {
                $this->result = json_encode(array('ok' => false, 'message' => 'Failed to update database!'));
            }
        }
    }

}