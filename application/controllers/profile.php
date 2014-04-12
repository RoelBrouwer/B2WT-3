<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('user_profiles');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in'))
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
		if ($this->session->userdata('logged_in'))
		{
			if ($this->form_validation->run() == FALSE)
			{
				$data = $this->user_profiles->get_user_by_nickname();
				$this->load->view('common/header');
				$this->load->view('change_brands', $data);
				$this->load->view('common/footer');
			}
			else
			{
			}
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
			if ($this->form_validation->run() == FALSE)
			{
				$data = $this->user_profiles->get_user_by_nickname();
				$this->load->view('common/header');
				$this->load->view('change_profile', $data);
				$this->load->view('common/footer');
			}
			else
			{
			}
		}
		else
		{
			redirect('auth');
		}
	}
}
?>