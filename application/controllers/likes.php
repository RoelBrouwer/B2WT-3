<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Likes extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','common_functions_helper'));
		$this->load->model('user_profiles');
		$this->load->model('likes_model');
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
			redirect('auth');
		}
		$this->load->view('likes_index');
		$this->load->view('common/footer');
	}
	
	public function my_likes() {
		$data['users'] = $this->likes_model->get_users_i_liked();
		$data['text'] = "blabla, bla, blabla <strong> jeej</strong> ";
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
		$this->load->view('likes_page', $data);
		$this->load->view('common/footer');
	}
	
	public function liked_me() {
		$data['users'] = $this->likes_model->get_users_liked_me();
		$data['text'] = "blabla, bla, blabla <strong> jeej</strong> ";
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
		$this->load->view('likes_page', $data);
		$this->load->view('common/footer');
	}
	
	public function match() {
		$data['users'] = $this->likes_model->get_likes_mutual();
		$data['text'] = "blabla, bla, blabla <strong> jeej</strong> ";
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
		$this->load->view('likes_page', $data);
		$this->load->view('common/footer');
	}
	
}
