<?php
/**
 * Main Enigma controller. Handles post from the Enigma simulation.
 * @author Charles B. Owen
 */

namespace Enigma;

/**
 * Main Enigma controller. Handles post from the Enigma simulation.
 */
class EnigmaController extends Controller {
	/**
	 * EnigmaController constructor.
	 * @param System $system System object
	 * @param array $post $_POST
	 */
	public function __construct(System $system, array $post) {
		parent::__construct($system);

		// Default will be to return to the enigma page
//		$this->setRedirect("../enigma.php#enigma");
        $lightedKey = '';
		if(!empty($post['key']) && $post['key']!=='reset') {
		    $system->press(strip_tags($post['key']));
		    $lightedKey = $system->getLighted();
        }

        if(!empty($post['key']) && $post['key'] === 'reset') {
		    $system->reset();
        }
//        print_r($post);
        $view = new EnigmaView($system);
        $this->result = json_encode(array('rotors'=>$view->presentRotors(), 'light'=>$lightedKey));
//        echo $this->result;
	}
    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
	private $result;
}