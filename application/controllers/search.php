<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_message('required','U bent vergeten uw %s in te voeren.');
		$this->form_validation->set_message('max_length','Uw %s is te lang.');
		$this->form_validation->set_message('min_length','Uw %s is te kort.');
		$this->form_validation->set_message('alpha_numeric','Gebruik alleen alfanumerieke karakters in %s.');
		$this->form_validation->set_message('alpha','Uw %s kan alleen uit letters bestaan.');
		$this->form_validation->set_message('is_natural','De %s moet een positief getal zijn.');
		$this->form_validation->set_message('date_validation','Voer een geldige %s in.');
		$this->form_validation->set_message('valid_email','Het ingevoerde e-mailadres is niet geldig.');
		$this->form_validation->set_message('less_than','De %s moet lager zijn dan 120.');
		$this->form_validation->set_message('check_ages','De gewenste maximumleeftijd moet groter zijn dan de gewenste minimumleeftijd.');
		
		
		$this->form_validation->set_rules('birthdate', 'geboortedatum', 'required|callback_date_validation|xss_clean');
		$this->form_validation->set_rules('gender', 'geslacht', 'required');
		$this->form_validation->set_rules('description', 'beschrijving', 'trim|required|max_length[500]s|xss_clean');
		$this->form_validation->set_rules('gender_pref', 'geslachtsvoorkeur', 'required');
		$this->form_validation->set_rules('min_age', 'gewenste minimumleeftijd', 'required|is_natural|less_than[120]');
	}

	function index()
	{
		$this->load->model('test_questions');
		$data['brands'] = $this->test_questions->get_brands();
		$this->load->view('search_form', $data);
	}
	function date_validation($string)
	{
		if ( preg_match('/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/', $string, $match) ) 
            return ( checkdate($match[2], $match[3], $match[1]) );
		else
			return false;
	}
	
	function check_ages($max, $min)
	{
		return ($max > $min);
	}
}