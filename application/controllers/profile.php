<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$this->load->model('user_profiles');
			$data = $this->user_profiles->get_user_by_nickname();
			$data['brandpref'] = $this->user_profiles->get_brandpref_by_id($data['user_id']);
			$data['personality'] = $this->_get_personality_string($this->user_profiles->get_personalitytype_by_id($data['user_id']));
			$this->load->view('common/header');
			$this->load->view('profile_page', $data);
			$this->load->view('common/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	public function _get_personality_string($pers)
	{
		$extravert = $pers['E'];
		if ($extravert >= 50) {
			$ei = "Extravert: " . round($extravert,1) . "%";
			$data['type'] = "E";
		}
		else {
			$ei = "Introvert: " . round((100 - $extravert),1) . "%";
			$data['type'] = "I";
		}
		$intuitive = $pers['N'];
		if ($intuitive >= 50) {
			$ns = "Intuitive: " . round($intuitive,1) . "%";
			$data['type'] = $data['type'] . "N"; 
		}
		else {
			$ns = "Sensing: " . round((100 - $intuitive),1) . "%";
			$data['type'] = $data['type'] . "S"; 
		}
		$thinking = $pers['T'];
		if ($thinking >= 50) {
			$tf = "Thinking: " . round($thinking,1) . "%";
			$data['type'] = $data['type'] . "T"; 
		}
		else {
			$tf = "Feeling: " . round((100 - $thinking),1) . "%";
			$data['type'] = $data['type'] . "F"; 
		}
		$judging = $pers['J'];
		if ($judging >= 50) {
			$jp = "Judging: " . round($judging,1) . "%";
			$data['type'] = $data['type'] . "J"; 
		}
		else {
			$jp = "Percieving: " . round((100 - $judging), 1) . "%";
			$data['type'] = $data['type'] . "P"; 
		}
		$data['percentage'] = $ei . "<br />" . $ns . "<br />" . $tf . "<br />" . $jp;
		
		return $data;
	}
	
	public function change_brands()
	{
		if ($this->session->userdata('logged_in'))
		{
			$this->load->view('common/header');
			$this->load->view('profile_page', NULL);
			$this->load->view('common/footer');
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
			$this->load->view('common/header');
			$this->load->view('profile_page', NULL);
			$this->load->view('common/footer');
		}
		else
		{
			redirect('auth');
		}
	}
}
?>