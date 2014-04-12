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
			$data['$personality'] = this->user_profiles->get_personalitytype_by_id($data['user_id']);
			$this->load->view('common/header');
			$this->load->view('profile_page', $data);
			$this->load->view('common/footer');
		}
		else
		{
			redirect('auth');
		}
	}
}
?>