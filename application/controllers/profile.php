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
		
		$this->form_validation->set_rules('username', 'gebruikersnaam', 'trim|min_length[3]|max_length[30]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('password', 'wachtwoord', 'trim|min_length[5]|max_length[255]|matches[password_check]|md5');
		$this->form_validation->set_rules('password_check', 'wachtwoord een tweede keer', 'trim');
		$this->form_validation->set_rules('email', 'e-mailadres', 'trim|valid_email');
		$this->form_validation->set_rules('first_name', 'voornaam', 'trim|alpha|xss_clean');
		$this->form_validation->set_rules('last_name', 'achternaam', 'trim|alpha|xss_clean');
		$this->form_validation->set_rules('birthdate', 'geboortedatum', 'xss_clean');
		$this->form_validation->set_rules('description', 'beschrijving', 'trim|max_length[500]s|xss_clean');
		$this->form_validation->set_rules('min_age', 'gewenste minimumleeftijd', 'is_natural|less_than[120]');
		$this->form_validation->set_rules('max_age', 'gewenste maximumleeftijd', 'is_natural|less_than[120]');
	}

	public function index()
	{
		if($this->user_profiles->is_admin()){
			$this->load->helper('common_functions_helper');
			$data = $this->user_profiles->get_user_by_nickname();
			$this->load->view('common/header_admin');
			$this->load->view('profile_page', $data);
			$this->load->view('common/footer');
		}
		elseif ($this->session->userdata('logged_in'))
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
				$this->load->model('test_questions');
				$data = $this->user_profiles->get_user_by_nickname();
				$data['brands'] = $this->test_questions->get_brands();
				$this->load->view('common/header');
				$this->load->view('change_brands', $data);
				$this->load->view('common/footer');
			}
			else
			{
				$this->user_profiles->update_brandspref();
				redirect('profile');
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
				if ($this->date_validation($this->input->post('birthdate'))) {
					if ($this->check_ages($this->input->post('max_age'),$this->input->post('min_age'))) {
						$this->user_profiles->update_user($data);
					}
				}
				redirect('profile');
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
	
	function deregister()
	{
		if ($this->session->userdata('logged_in'))
		{
			if($this->user_profiles->delete_user())
			{
				$this->session->sess_destroy();
				redirect('');
			}
			else
			{
				redirect('profile');
			}
		}
		else
		{
			redirect('auth');
		}
	}
	
	function user($id) //Profiel detail-pagina
	{ //Je hoeft niet ingelogd te zijn om dit te mogen bekijken...
		$user_data = $this->user_profiles->get_user_by_id($id);
		$user_data['usr_logged_in'] = $this->session->userdata('logged_in');
		if ($this->session->userdata('logged_in'))
		{
			if ($user_data['nickname'] == $this->session->userdata('nickname'))
			{
				redirect('profile');
			}
		}
		$this->load->view('common/header');
		$this->load->view('profile_detail', $user_data);
		$this->load->view('common/footer');
	}
	
	function likeuser($id)
	{
		$this->load->model('likes_model');
		$this->likes_model->add_like($id);
		redirect('profile/user/'.$id);
	}
}
?>