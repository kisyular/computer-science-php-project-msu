<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/11
 * Time: 4:02 PM
 */

namespace Felis;


class HomeView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }
    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }
    /**
     * Add content to testimonials
     */
    public function addTestimonial($text,$name){
        static $count = 0;
        $count++;
        $html = <<<HTML
<blockquote>
        <p>$text</p>
        <cite>$name</cite>
</blockquote>
HTML;

        if($count%2 !== 0){
            $this->leftTestimonial .= $html;
        }
        else{
            $this->rightTestimonial .= $html;
        }

    }
    public function testimonials(){
        $html = <<<HTML
<section class="testimonials">
    <h2>TESTIMONIALS</h2>
    <div class="left">
    $this->leftTestimonial
    </div>
    <div class="right">
    $this->rightTestimonial
    </div>
</section>
HTML;
        return $html;

    }
    private $leftTestimonial;
    private $rightTestimonial;

}