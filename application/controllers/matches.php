<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matches extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','common_functions_helper'));
		$this->load->library('form_validation');
		$this->load->model('user_profiles');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$data['user'] = $this->_matched_users(); //array(1,2,3); //array of users
			$this->load->view('common/header');
			$this->load->view('display_matches', $data);
			$this->load->view('common/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	public function _matched_users()
	{
		$matches1 = $this->user_profiles->get_users_matching_pref(); //Get the users that match the pref
		$this->_assign_ranking($matches1);
		return $matches1;
	}
	
	public function _assign_ranking($users)
	{
		foreach ($users as $user)
		{
			$pers_dist = _get_distance($user);
		}
	}
	
	public function _get_distance($user)
	{
		$curr_user = $this->user_profiles->get_user_by_nickname();
	}

}