<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_message('required','U bent vergeten %s in te vullen.');
		$this->form_validation->set_rules('q1', 'vraag 1', 'required');
		$this->form_validation->set_rules('q2', 'vraag 2', 'required');
		$this->form_validation->set_rules('q3', 'vraag 3', 'required');
		$this->form_validation->set_rules('q4', 'vraag 4', 'required');
		$this->form_validation->set_rules('q5', 'vraag 5', 'required');
		$this->form_validation->set_rules('q6', 'vraag 6', 'required');
		$this->form_validation->set_rules('q7', 'vraag 7', 'required');
		$this->form_validation->set_rules('q8', 'vraag 8', 'required');
		$this->form_validation->set_rules('q9', 'vraag 9', 'required');
		$this->form_validation->set_rules('q10', 'vraag 10', 'required');
		$this->form_validation->set_rules('q11', 'vraag 11', 'required');
		$this->form_validation->set_rules('q12', 'vraag 12', 'required');
		$this->form_validation->set_rules('q13', 'vraag 13', 'required');
		$this->form_validation->set_rules('q14', 'vraag 14', 'required');
		$this->form_validation->set_rules('q15', 'vraag 15', 'required');
		$this->form_validation->set_rules('q16', 'vraag 16', 'required');
		$this->form_validation->set_rules('q17', 'vraag 17', 'required');
		$this->form_validation->set_rules('q18', 'vraag 18', 'required');
		$this->form_validation->set_rules('q19', 'vraag 19', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			//Vul de $data met alle vragen, waarbij vragen bestaan uit een formulering van de vraag, een label voor de vraag en een array met 3 antwoorden. Elk antwoord is ook weer een array van een value en een tekst.
			
			$this->load->model('test_questions');
			$data['questions'] = $this->test_questions->get_questions();
			$this->load->view('personality_test', $data);
		}
		else
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
				$data['type'] = "E";
			}
			else {
				$ei = "Introvert: " . (100 - $extravert) . "%";
				$data['type'] = "I";
			}
			$intuitive = 50 + (12.5 * $type_occ['N']) - (12.5 * $type_occ['S']);
			if ($intuitive >= 50) {
				$ns = "Intuitive: " . $intuitive . "%";
				$data['type'] = $data['type'] . "N"; 
			}
			else {
				$ns = "Sensing: " . (100 - $intuitive) . "%";
				$data['type'] = $data['type'] . "S"; 
			}
			$thinking = 50 + (12.5 * $type_occ['T']) - (12.5 * $type_occ['F']);
			if ($thinking >= 50) {
				$tf = "Thinking: " . $thinking . "%";
				$data['type'] = $data['type'] . "T"; 
			}
			else {
				$tf = "Feeling: " . (100 - $thinking) . "%";
				$data['type'] = $data['type'] . "F"; 
			}
			$judging = 50 + ((50/6) * $type_occ['J']) - ((50/6) * $type_occ['P']);
			if ($judging >= 50) {
				$jp = "Judging: " . $judging . "%";
				$data['type'] = $data['type'] . "J"; 
			}
			else {
				$jp = "Percieving: " . round((100 - $judging), 1) . "%";
				$data['type'] = $data['type'] . "P"; 
			}
			$data['percentage'] = $ei . "<br />" . $ns . "<br />" . $tf . "<br />" . $jp;
			$this->load->view('test_succes', $data);
		}
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