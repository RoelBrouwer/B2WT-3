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
		$this->form_validation->set_rules('q1', 'antwoord bij vraag 1 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q2', 'antwoord bij vraag 2 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q3', 'antwoord bij vraag 3 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q4', 'antwoord bij vraag 4 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q5', 'antwoord bij vraag 5 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q6', 'antwoord bij vraag 6 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q7', 'antwoord bij vraag 7 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q8', 'antwoord bij vraag 8 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q9', 'antwoord bij vraag 9 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q10', 'antwoord bij vraag 10 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q11', 'antwoord bij vraag 11 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q12', 'antwoord bij vraag 12 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q13', 'antwoord bij vraag 13 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q14', 'antwoord bij vraag 14 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q15', 'antwoord bij vraag 15 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q16', 'antwoord bij vraag 16 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q17', 'antwoord bij vraag 17 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q18', 'antwoord bij vraag 18 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('q19', 'antwoord bij vraag 19 van de persoonlijkheidstest', 'required');
		$this->form_validation->set_rules('brandpref', 'merkvoorkeuren', 'required');
	}
	
	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			redirect('');
		}
		else
		{
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('test_questions');
				$data['questions'] = $this->test_questions->get_questions();
				$data['brands'] = $this->test_questions->get_brands();
				$this->load->view('registration_form', $data);
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
				$message .= "<p><a href= '". base_url()."reg/confirm/$key'>Bevestig uw registratie</a>.</p>";
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
				$this->login->brand_preference($key);
				$this->load->view('common/header');
				$this->load->view('test_succes', $this->login->personality_type($key));
				$this->load->view('common/footer');
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
		if ( preg_match('/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/', $string, $match) ) 
            return ( checkdate($match[2], $match[3], $match[1]) );
		else
			return false;
	}
	
	function check_ages($max, $min)
	{
		return ($max > $min);
	}

	function do_upload()
	{
		if ( ! $this->reg->do_upload())
		{
			// display errors
			$error = array('error' => $this->reg->display_errors());

			$this->load->view('', $error);
		}
		else
		{
			//Upload and Resize the image
			$data = array('upload_data' => $this->reg->data());
			$this->resize($data['upload_data']['full_path'], $data['upload_data']['file_name']);
			$this->load->view('', $data);
		}
	}

	function resize($path, $file)
	{
		$config['image_library']	= 	'gd2'; //or imagemagick
		$config['source_image'] 	= 	$path;
		$config['create_thumb']  	= 	TRUE;
		$config['maintain_ratio']	=	TRUE;
		$config['width']			=	150;
		$config['height']			=	75;
		$config['new_image']		=	'./assets/uploads/'.$file;

		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	}
}
?>