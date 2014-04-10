<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_message('required','U bent vergeten een %s in te voeren.');
		$this->form_validation->set_message('alpha_numeric','Ongeldige gebruikersnaam/wachtwoord combinatie.');
		
		$this->form_validation->set_rules('username', 'gebruikersnaam', 'trim|required|alpha_numeric|xss_clean|callback_validate_username');
		$this->form_validation->set_rules('password', 'wachtwoord', 'trim|required|md5');
	}

	public function index()
	{
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('log_in');
		}
		else
		{
			redirect('');
		}
	}
	
	public function validate_username()
	{
		$this->load->model('login');
		
		if ($this->login->able_login())
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('validate_username','Ongeldige gebruikersnaam/wachtwoord combinatie.');
			return false;
		}
	}
	
} ?>