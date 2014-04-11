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
		$data = array();
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