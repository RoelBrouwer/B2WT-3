<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->model('user_profiles');
		$data['profiles'] = $this->get_six_profiles();
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		if($this->user_profiles->is_admin()){
			$this->load->view('common/header_admin');
	    	$this->load->view('index', $data);
			$this->load->view('common/footer');
		}
		elseif ($this->session->userdata('logged_in'))
		{
			$this->load->view('common/header');
		    $this->load->view('index', $data);
			$this->load->view('common/footer');
		}
		else
		{
			$this->load->view('common/header_anon');
			$this->load->view('index', $data);
			$this->load->view('common/footer');
		}
		
	}
	
	public function get_six_profiles()
	{
		$user1 = $this->user_profiles->get_random_user_profile();
		$user2 = $this->user_profiles->get_random_user_profile();
		$user3 = $this->user_profiles->get_random_user_profile();
		$user4 = $this->user_profiles->get_random_user_profile();
		$user5 = $this->user_profiles->get_random_user_profile();
		$user6 = $this->user_profiles->get_random_user_profile();
		//Hier later nog de juiste foto erin stoppen, de persoonlijkheid erbij halen en de merkvoorkeuren pakken.
		$six = array(
			'person1' => $user1,
			'person2' => $user2,
			'person3' => $user3,
			'person4' => $user4,
			'person5' => $user5,
			'person6' => $user6
		);
		return $six;
	}
}