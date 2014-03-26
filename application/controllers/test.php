<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		//Vul de $data met alle vragen, waarbij vragen bestaan uit een formulering van de vraag, een label voor de vraag en een array met 3 antwoorden. Elk antwoord is ook weer een array van een value en een tekst.
		
		//@TODO: De vragen moeten eigenlijk uit de database opgehaald worden in de toekomst
		$data['questions'] = array('q1' => array('question' => "Tekst voor vraag 1", 'tag' => "q1", 'answers' => array('a' => array('value' => "tag1", 'text' => "Tekst1"), 'b' => array('value' => "tag2", 'text' => "Tekst2"), 'c' => array('value' => "tag3", 'text' => "Tekst3"))), 'q2' => array('question' => "Tekst voor vraag 2", 'tag' => "q2", 'answers' => array('a' => array('value' => "tag4", 'text' => "Tekst4"), 'b' => array('value' => "tag5", 'text' => "Tekst5"), 'c' => array('value' => "tag6", 'text' => "Tekst6"))));
		$this->load->view('personality_test', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */