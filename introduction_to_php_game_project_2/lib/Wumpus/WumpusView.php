<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/05/29
 * Time: 12:12 PM
 */

namespace Wumpus;


class WumpusView
{
    private $wumpus;    // The Wumpus object
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     */
    public function __construct(Wumpus $wumpus) {
        $this->wumpus = $wumpus;
    }
    /**
     * Generate the HTML for the number of arrows remaining
     * @return string HTML
     */
    public function presentArrows() {
        $a = $this->wumpus->numArrows();
        return "<p>You have $a arrows remaining.</p>";
    }

    /**
     * Generate the HTML for the current status
     * @return string
     */
    public function presentStatus() {
        $room = $this->wumpus->getCurrent()->getNum();

        $html = <<<HTML
<p class="first">You are in room $room</p>
HTML;
        if($this->wumpus->hearBirds()){
            $html .= '<p>You hear birds!</p>';
        }
        if($this->wumpus->feelDraft()){
            $html .= '<p>You  feel a draft!</p>';
        }
        if($this->wumpus->smellWumpus()) {
            $html .= '<p>You smell a wumpus!</p>';
        }
        if($this->wumpus->wasCarried()){
            $html.= "<p>You were carried by the birds to room $room!</p>";
        }


        return $html;
    }
    /**
     * Present the links for a room
     * @param int $ndx An index 0 to 2 for the three rooms
     * @return string HTML
     */
    public function presentRoom($ndx) {
        $room = $this->wumpus->getCurrent()->getNeighbors()[$ndx];
        $roomnum = $room->getNum();
        $roomndx = $room->getNdx();
        $roomurl = "game-post.php?m=$roomndx";
        $shooturl = "game-post.php?s=$roomndx";

        $html = <<<HTML
<div class="room">
  <p><img src="cave2.jpg" width="180" height="135" alt=""/></p>
  <p><a href="$roomurl">$roomnum</a></p>
<p><a href="$shooturl">Shoot Arrow</a></p>
</div>
HTML;

        return $html;
    }


}