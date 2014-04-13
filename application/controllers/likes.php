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
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		$data['text'] = "<h2>Mijn likes</h2> Hieronder vind je een overzicht van alle gebruikers die je ge-liked hebt. ";
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
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		$data['text'] = "<h2>Wie liket mij?</h2> Hieronder vind je een overzicht van alle gebruikers die jou ge-liked hebben. ";
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
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		$data['text'] = "<h2>Matches</h2> Hieronder vind je een overzicht van alle gebruikers die je ge-liked hebt en die jou ook ge-liked hebben: gebruikers waarmee de likes matchen!";
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
