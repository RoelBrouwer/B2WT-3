<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','common_functions_helper'));
		$this->load->library('form_validation');
		$this->load->model('user_profiles');
		
		$this->form_validation->set_message('required','U hebt niets ingevuld bij %s.');
		$this->form_validation->set_message('max_length','Uw %s is te lang.');
		$this->form_validation->set_message('min_length','Uw %s is te kort.');
		$this->form_validation->set_message('alpha_numeric','Gebruik alleen alfanumerieke karakters in %s.');
		$this->form_validation->set_message('alpha','Uw %s kan alleen uit letters bestaan.');
		$this->form_validation->set_message('is_natural','De %s moet een positief getal zijn.');
		$this->form_validation->set_message('date_validation','Voer een geldige %s in.');
		$this->form_validation->set_message('valid_email','Het ingevoerde e-mailadres is niet geldig.');
		$this->form_validation->set_message('less_than','De %s moet lager zijn dan 120.');
		$this->form_validation->set_message('check_ages','De gewenste maximumleeftijd moet groter zijn dan de gewenste minimumleeftijd.');
		$this->form_validation->set_message('matches','De twee ingevoerde wachtwoorden zijn niet gelijk.');
		$this->form_validation->set_message('is_unique','%s is al in gebruik.');
		
		$this->form_validation->set_rules('username', 'gebruikersnaam', 'trim|required|min_length[3]|max_length[30]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('password', 'wachtwoord', 'trim|min_length[5]|max_length[255]|matches[password_check]|md5');
		$this->form_validation->set_rules('password_check', 'wachtwoord een tweede keer', 'trim');
		$this->form_validation->set_rules('email', 'e-mailadres', 'trim|required|valid_email');
		$this->form_validation->set_rules('first_name', 'voornaam', 'trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('last_name', 'achternaam', 'trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('birthdate', 'geboortedatum', 'required|callback_date_validation|xss_clean');
		$this->form_validation->set_rules('gender', 'geslacht', 'required');
		$this->form_validation->set_rules('description', 'beschrijving', 'trim|required|max_length[500]s|xss_clean');
		$this->form_validation->set_rules('gender_pref', 'geslachtsvoorkeur', 'required');
		$this->form_validation->set_rules('min_age', 'gewenste minimumleeftijd', 'required|is_natural|less_than[120]');
		$this->form_validation->set_rules('max_age', 'gewenste maximumleeftijd', 'required|is_natural|less_than[120]|callback_check_ages['.$this->input->post('min_age').']');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$this->load->helper('common_functions_helper');
			$data = $this->user_profiles->get_user_by_nickname();
			$this->load->view('common/header');
			$this->load->view('profile_page', $data);
			$this->load->view('common/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	public function change_brands()
	{
		if ($this->session->userdata('logged_in'))
		{
			if ($this->form_validation->run() == FALSE)
			{
				$data = $this->user_profiles->get_user_by_nickname();
				$this->load->view('common/header');
				$this->load->view('change_brands', $data);
				$this->load->view('common/footer');
			}
			else
			{
			}
		}
		else
		{
			redirect('auth');
		}
	}
	
	public function change_profile()
	{
		if ($this->session->userdata('logged_in'))
		{
			$data = $this->user_profiles->get_user_by_nickname();
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('common/header');
				$this->load->view('change_profile', $data);
				$this->load->view('common/footer');
			}
			else
			{
				$this->user_profiles->update_user($data);
			}
		}
		else
		{
			redirect('auth');
		}
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
?>