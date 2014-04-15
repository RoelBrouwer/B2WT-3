<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends CI_Controller {
	
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
		$data['text'] = "<h2>Contact</h2><p>Wil u in contact komen met de beheerders van deze website, stuur dan een e-mail naar <a href='mailto:H.Q.Lu@students.uu.nl?Subject=DataDate' target='_top'>H.Q. Lu</a> of <a href='mailto:R.J.J.Brouwer@students.uu.nl?Subject=DataDate' target='_top'>R.J.J. Brouwer</a>.</p>";
		$this->load->view('about_view', $data);
		$this->load->view('common/footer');
	}
	
}