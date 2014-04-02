<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reg extends CI_Controller {
	
	public function index()
	{
		
		$this->load->view('registration_form', NULL);
	}
	
	function submit_form()
	{
		
	}
}
?>