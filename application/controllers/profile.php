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
		if ($this->form_validation->run() == FALSE)
		{
			if($this->user_profiles->is_admin()){
				$this->load->view('common/header_admin');
			}
			elseif ($this->session->userdata('logged_in'))
			{
				$this->load->view('common/header');
			}
			else
			{
				redirect('auth');
			}
			$this->load->model('test_questions');
			$data = $this->user_profiles->get_user_by_nickname();
			$data['brands'] = $this->test_questions->get_brands();
			$this->load->view('change_brands', $data);
			$this->load->view('common/footer');
		}
		else
		{
			if ($this->session->userdata('logged_in'))
			{
				$this->user_profiles->update_brandspref();
				redirect('profile');
			}
			else { redirect('auth'); }
		}
	}
	
	public function change_profile()
	{
		if ($this->session->userdata('logged_in'))
		{
			$data = $this->user_profiles->get_user_by_nickname();
			if ($this->form_validation->run() == FALSE)
			{
				if($this->user_profiles->is_admin()){
					$this->load->view('common/header_admin');
				}
				else
				{
					$this->load->view('common/header');
				}
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
	
	public function change_picture()
	{
		// if ($this->session->userdata('logged_in'))
		// {
			// $data = $this->user_profiles->get_user_by_nickname();
			// if ($this->form_validation->run() == FALSE)
			// {
				// if($this->user_profiles->is_admin()){
					// $this->load->view('common/header_admin');
				// }
				// else
				// {
					// $this->load->view('common/header');
				// }
				// $this->load->view('change_profile', $data);
				// $this->load->view('common/footer');
			// }
			// else
			// {
				// if ($this->date_validation($this->input->post('birthdate'))) {
					// if ($this->check_ages($this->input->post('max_age'),$this->input->post('min_age'))) {
						// $this->user_profiles->update_user($data);
					// }
				// }
				// redirect('profile');
			// }
		// }
		// else
		// {
			// redirect('auth');
		// }
	}
	
	public function add_picture()
	{
		$this->load->view('common/header');
		$this->load->view('upload_form', array('error'=>'', 'var' => 1));
		$this->load->view('common/footer');
		// if ($this->session->userdata('logged_in'))
		// {
			// $data = $this->user_profiles->get_user_by_nickname();
			// if ($this->form_validation->run() == FALSE)
			// {
				// if($this->user_profiles->is_admin()){
					// $this->load->view('common/header_admin');
				// }
				// else
				// {
					// $this->load->view('common/header');
				// }
				// $this->load->view('change_profile', $data);
				// $this->load->view('common/footer');
			// }
			// else
			// {
				// if ($this->date_validation($this->input->post('birthdate'))) {
					// if ($this->check_ages($this->input->post('max_age'),$this->input->post('min_age'))) {
						// $this->user_profiles->update_user($data);
					// }
				// }
				// redirect('profile');
			// }
		// }
		// else
		// {
			// redirect('auth');
		// }
	}
	
	public function delete_picture()
	{
		// if ($this->session->userdata('logged_in'))
		// {
			// $data = $this->user_profiles->get_user_by_nickname();
			// if ($this->form_validation->run() == FALSE)
			// {
				// if($this->user_profiles->is_admin()){
					// $this->load->view('common/header_admin');
				// }
				// else
				// {
					// $this->load->view('common/header');
				// }
				// $this->load->view('change_profile', $data);
				// $this->load->view('common/footer');
			// }
			// else
			// {
				// if ($this->date_validation($this->input->post('birthdate'))) {
					// if ($this->check_ages($this->input->post('max_age'),$this->input->post('min_age'))) {
						// $this->user_profiles->update_user($data);
					// }
				// }
				// redirect('profile');
			// }
		// }
		// else
		// {
			// redirect('auth');
		// }
	}
	
	function do_upload($mode)
	{
		//mode 1 is nieuwe foto, mode 2 is foto veranderen
		$config['upload_path'] = './assets/uploads';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '2000';
		$config['max_height']  = '800';

		$this->load->library('upload', $config);
		// if doesn't upload
		if ( ! $this->upload->do_upload())
		{
			// display errors
			$error = array('error' => $this->upload->display_errors());
			
			if ($this->user_profiles->is_admin()) {
				$this->load->view('common/header_admin');
			} else {
				$this->load->view('common/header');
			}
			$this->load->view('upload_form', $error);
			$this->load->view('common/footer');
		}
		else
		{
			//Upload and Resize the image
			$data = array('upload_data' => $this->upload->data());
			$this->resize($data['upload_data']['full_path'], $data['upload_data']['file_name']);
			$images = array('picture' => $data['upload_data']['file_name'], 'thumb' => "thumb_" . $info['upload_data']['file_name']);
			if ($mode == 1)
			{
				$this->user_profiles->add_picture($images);
			}
			elseif ($mode == 2)
			{
				//Ga updaten en oude afbeelding verwijderen
			}
			redirect('profile');
		}
	}

	function resize($path, $file)
	{
		$config['image_library']	= 	'gd2'; //or imagemagick
		$config['source_image'] 	= 	$path;
		$config['create_thumb']  	= 	FALSE;
		$config['maintain_ratio']	=	TRUE;
		$config['width']			=	100;
		$config['height']			=	200;
		$config['new_image']		=	'./assets/uploads/thumb_'.$file;

		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
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
		if($this->user_profiles->is_admin()){
			$this->load->view('common/header_admin');
		}
		elseif ($this->session->userdata('logged_in')) {
			$this->load->view('common/header');
		}
		else {
		$this->load->view('common/header_anon');
		}
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