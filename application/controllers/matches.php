<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matches extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$data['user'] = array(1,2,3); //array of users
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
		$this->some_model->get_users_matching_pref() //Get the users that match the pref
	}

}