<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Likes extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','common_functions_helper'));
		$this->load->model('user_profiles');
	}

	public function index() {
		if($this->user_profiles->is_admin()){
			$this->load->view('common/header_admin');
		}
		elseif ($this->session->userdata('logged_in'))
		{
			$this->load->view('common/header');
		}
		else
		{
			$this->load->view('common/header_anon');
		}
		$this->load->view('likes_index');
		$this->load->view('common/footer');
	}
	
	public function my_likes() {
		if($this->user_profiles->is_admin()){
			$this->load->view('common/header_admin');
		}
		elseif ($this->session->userdata('logged_in'))
		{
			$this->load->view('common/header');
		}
		else
		{
			$this->load->view('common/header_anon');
		}
		$this->load->view('likes_index');
		$this->load->view('common/footer');
	}
	
	public function liked_me() {
		if($this->user_profiles->is_admin()){
			$this->load->view('common/header_admin');
		}
		elseif ($this->session->userdata('logged_in'))
		{
			$this->load->view('common/header');
		}
		else
		{
			$this->load->view('common/header_anon');
		}
		$this->load->view('likes_index');
		$this->load->view('common/footer');
	}
	
	public function match() {
		if($this->user_profiles->is_admin()){
			$this->load->view('common/header_admin');
		}
		elseif ($this->session->userdata('logged_in'))
		{
			$this->load->view('common/header');
		}
		else
		{
			$this->load->view('common/header_anon');
		}
		$this->load->view('likes_index');
		$this->load->view('common/footer');
	}
	
}
