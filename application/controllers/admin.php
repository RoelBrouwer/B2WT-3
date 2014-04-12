<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_profiles');
		$this->load->model('admin_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_message('required','U bent vergeten de %s in te voeren.');
		$this->form_validation->set_message('numeric','Gebruik alleen numerieke karakters in %s.');
		$this->form_validation->set_message('is_natural_no_zero','De %s moet een positief getal zijn.');
		$this->form_validation->set_message('less_than','De %s is te hoog.');
		$this->form_validation->set_message('more_than','De %s is te laag.');

		$this->form_validation->set_rules('alpha', 'gewenste minimumleeftijd', 'required|numeric|less_than[1]|greater_than[0]');
		$this->form_validation->set_rules('xfactor', 'gewenste minimumleeftijd', 'required|numeric|less_than[1]|greater_than[0]');
		$this->form_validation->set_rules('distance_measure', 'distance measure', 'required|is_natural_no_zero|less_than[4]');
	}
	
	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			if ($this->user_profiles->is_admin())
			{
				if ($this->form_validation->run() == FALSE)
				{
					$data['alpha'] = $this->admin_model->get_alpha();
					$data['xfactor'] = $this->admin_model->get_xfactor();
					$data['distance_measure'] = $this->admin_model->get_distance_measure();
					$this->load->view('common/header');
					$this->load->view('admin_view', $data);
					$this->load->view('common/footer');
				}
				else
				{
					$this->admin_model->set_alpha($this->input->post('alpha'));
					$this->admin_model->set_xfactor($this->input->post('xfactor'));
					$this->admin_model->set_distance_measure($this->input->post('distance_measure'));
					redirect('admin');
				}
			}
			else
			{
				redirect('');
			}
		}
		else
		{
			redirect('auth');
		}
	}
}
?>