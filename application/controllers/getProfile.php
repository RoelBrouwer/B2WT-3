<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetProfile extends CI_Controller {

	public function index()
	{
		$this->load->model('user_profiles');
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