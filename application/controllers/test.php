<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		//Vul de $data met alle vragen, waarbij vragen bestaan uit een formulering van de vraag, een label voor de vraag en een array met 3 antwoorden. Elk antwoord is ook weer een array van een value en een tekst.
		
		$this->load->model('test_questions');
		$data['questions'] = $this->test_questions->get_questions();
		$this->load->view('personality_test', $data);
	}
	
	function retrieve_answers()
	{
		$form_in = $this->input->post();
		$type_occ = array_count_values($form_in);
		$types = array('E', 'I', 'N','S', 'T', 'F', 'J', 'P');
		foreach ($types as $type) {
			if (!isset($type_occ[$type]))
			{
				$type_occ[$type] = 0;
			}
		}
		$extravert = 50 + (10 * $type_occ['E']) - (10 * $type_occ['I']);
		if ($extravert >= 50) {
			$ei = "Extravert: " . $extravert . "%";
		}
		else {
			$ei = "Introvert: " . (100 - $extravert) . "%";
		}
		$intuitive = 50 + (12.5 * $type_occ['N']) - (12.5 * $type_occ['S']);
		if ($intuitive >= 50) {
			$ns = "Intuitive: " . $intuitive . "%";
		}
		else {
			$ns = "Sensing: " . (100 - $intuitive) . "%";
		}
		$thinking = 50 + (12.5 * $type_occ['T']) - (12.5 * $type_occ['F']);
		if ($thinking >= 50) {
			$tf = "Thinking: " . $thinking . "%";
		}
		else {
			$tf = "Feeling: " . (100 - $thinking) . "%";
		}
		$judging = 50 + ((50/6) * $type_occ['J']) - ((50/6) * $type_occ['P']);
		if ($judging >= 50) {
			$jp = "Judging: " . $judging . "%";
		}
		else {
			$jp = "Percieving: " . round((100 - $judging), 1) . "%";
		}
		$data['debuginfo'] = $ei . "<br />" . $ns . "<br />" . $tf . "<br />" . $jp;
		$this->load->view('personality_test', $data);
	}
}
?>