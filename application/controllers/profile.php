<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

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