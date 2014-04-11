<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$data = get_six_profiles();
		$this->load->view('common/header');
		$this->load->view('index', $data);
		$this->load->view('common/footer');
	}
	
	public function get_six_profiles()
	{
		$this->load->model('user_profiles');
		$user1 = array_shift(array_values($this->user_profiles->get_random_user_profile()));
		$user2 = array_shift(array_values($this->user_profiles->get_random_user_profile()));
		$user3 = array_shift(array_values($this->user_profiles->get_random_user_profile()));
		$user4 = array_shift(array_values($this->user_profiles->get_random_user_profile()));
		$user5 = array_shift(array_values($this->user_profiles->get_random_user_profile()));
		$user6 = array_shift(array_values($this->user_profiles->get_random_user_profile()));
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */