<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reg extends CI_Controller {
	
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_message('required','U bent vergeten uw %s in te voeren.');
		$this->form_validation->set_message('max_length','Uw %s is te lang.');
		$this->form_validation->set_message('min_length','Uw %s is te kort.');
		$this->form_validation->set_message('alpha_numeric','Gebruik alleen alfanumerieke karakters in %s.');
		$this->form_validation->set_message('alpha','Gebruik alleen letters in %s.');
		$this->form_validation->set_message('is_natural','De %s moet een getal zijn.');
		$this->form_validation->set_message('date_validation','Voer een geldige %s in.');
		$this->form_validation->set_rules('username', 'gebruikersnaam', 'trim|required|min_length[3]|max_length[30]|is_unique[users.nickname]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('password', 'wachtwoord', 'trim|required|matches[password_check]|md5');
		$this->form_validation->set_rules('password_check', 'wachtwoord een tweede keer', 'trim|required');
		$this->form_validation->set_rules('email', 'e-mailadres', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('first_name', 'voornaam', 'trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('last_name', 'achternaam', 'trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('birthdate', 'geboortedatum', 'required|callback_date_validation|xss_clean');
		$this->form_validation->set_rules('gender', 'geslacht', 'required');
		$this->form_validation->set_rules('picture', 'foto', '');
		$this->form_validation->set_rules('description', 'beschrijving', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gender_pref', 'geslachtsvoorkeur', 'required');
		$this->form_validation->set_rules('min_age', 'gewenste minimumleeftijd', 'required|is_natural|less_than[120]');
		$this->form_validation->set_rules('max_age', 'gewenste maximumleeftijd', 'required|is_natural|less_than[120]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('registration_form', NULL);
		}
		else
		{
		}
	}
	
	function date_validation($string) {
		if ( preg_match('/^([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})$/', $string, $match) ) 
            return ( checkdate($match[2], $match[1], $match[3]) );
		else
			return false;
	}
}
?>