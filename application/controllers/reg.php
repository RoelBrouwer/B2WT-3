<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reg extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width'] = '1000';
		$config['max_height'] = '1000';
		$this->load->library('upload', $config);
		
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
		$this->form_validation->set_message('matches','De twee ingevoerde wachtwoorden zijn niet gelijk.');
		$this->form_validation->set_message('is_unique','%s is al in gebruik.');
		
		$this->form_validation->set_rules('username', 'gebruikersnaam', 'trim|required|min_length[3]|max_length[30]|is_unique[users.nickname]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('password', 'wachtwoord', 'trim|required|min_length[5]|max_length[255]|matches[password_check]|md5');
		$this->form_validation->set_rules('password_check', 'wachtwoord een tweede keer', 'trim|required');
		$this->form_validation->set_rules('email', 'e-mailadres', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('first_name', 'voornaam', 'trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('last_name', 'achternaam', 'trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('birthdate', 'geboortedatum', 'required|callback_date_validation|xss_clean');
		$this->form_validation->set_rules('gender', 'geslacht', 'required');
		$this->form_validation->set_rules('picture', 'foto', '');
		$this->form_validation->set_rules('description', 'beschrijving', 'trim|required|max_length[500]s|xss_clean');
		$this->form_validation->set_rules('gender_pref', 'geslachtsvoorkeur', 'required');
		$this->form_validation->set_rules('min_age', 'gewenste minimumleeftijd', 'required|is_natural|less_than[120]');
		$this->form_validation->set_rules('max_age', 'gewenste maximumleeftijd', 'required|is_natural|less_than[120]|callback_check_ages['.$this->input->post('min_age').']');
	}
	
	public function index()
	{
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('registration_form', NULL);
		}
		else
		{
			$key = md5(uniqid());
			
			$this->load->library('email', array('mailtype' => 'html'));
			$this->load->model('login');
			
			$this->email->from('email@email.com', "DataDate");
			$this->email->to($this->input->post('email'));
			$this->email->subject("Uw registratie bij DataDate.");
			
			$message = "<h2>Welkom bij DataDate!</h2><p>Wij heten u van harte welkom in onze DataDate-community. Klik op de onderstaande link om uw registratie te bevestigen:</p>";
			$message .= "<p><a href= '". base_url()."reg/confirm/$key'>Bevestig ue registratie</a>.</p>";
			$this->email->message($message);
			if ($this->login->add_temp_user($key))
			{
				if ($this->email->send()){
					echo "Een bevestiging-mail is verstuurd.";
				}
				else
				{
					echo "Er is iets misgegaan. Probeer het opnieuw.";
				}
			}
			else
			{
				echo "Er is iets misgegaan. Probeer het opnieuw.";
			}		
		}
	}
	
	public function confirm($key)
	{
		$this->load->model('login');
		
		if ($this->login->check_key($key))
		{
			if ($this->login->add_user($key))
			{
				echo "Uw registratie is bevestigd. U kunt nu inloggen."; //Of redirecten ergens daarnaartoe.
			}
			else
			{
				echo "Er is iets misgegaan. Probeer het opnieuw.";
			}
		}
	}
	
	function date_validation($string)
	{
		if ( preg_match('/^([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})$/', $string, $match) ) 
            return ( checkdate($match[2], $match[1], $match[3]) );
		else
			return false;
	}
	
	function check_ages($max, $min)
	{
		return ($max > $min);
	}
	
	//Currently useless..
	function do_upload()
	{
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('', $data);
		}
	}
}
?>