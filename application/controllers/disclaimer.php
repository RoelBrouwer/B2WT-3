<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Disclaimer extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_profiles');
	}

	public function index()
	{
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
		$data['text'] = "<h2>Disclaimer</h2><p>This is an educational project. <br />We made an effort not to include any copyrighted material in our webpage/our application.<br />If we accidentally did use material to which you own the rights, we are willing to resolve the issue and we ask you to <a href='". base_url() . "contact'>contact us</a>.</p>";
		$this->load->view('about_view', $data);
		$this->load->view('common/footer');
	}
	
}