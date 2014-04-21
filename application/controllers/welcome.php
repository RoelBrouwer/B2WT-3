<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['profiles'] = $this->get_six_profiles();
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		if($this->user_profiles->is_admin()){
			$this->load->view('common/header_admin');
	    	$this->load->view('index', $data);
			$this->load->view('common/footer');
		}
		elseif ($this->session->userdata('logged_in'))
		{
			$this->load->view('common/header');
		    $this->load->view('index', $data);
			$this->load->view('common/footer');
		}
		else
		{
			$this->load->view('common/header_anon');
			$this->load->view('index', $data);
			$this->load->view('common/footer');
		}
		
	}
	
	public function get_six_profiles()
	{
		$this->load->model('user_profiles');
		if ($this->session->userdata('logged_in'))
		{
			$userf = $this->user_profiles->get_user_by_nickname();
			$own = $userf['user_id'];
		}
		else
		{
			$own = 'doesntmatter';
		}
		$user1 = $this->make_sure_unique(array($own));
		$user2 = $this->make_sure_unique(array($own, $user1['user_id']));
		$user3 = $this->make_sure_unique(array($own, $user1['user_id'], $user2['user_id']));
		$user4 = $this->make_sure_unique(array($own, $user1['user_id'], $user2['user_id'], $user3['user_id']));
		$user5 = $this->make_sure_unique(array($own, $user1['user_id'], $user2['user_id'], $user3['user_id'], $user4['user_id']));
		$user6 = $this->make_sure_unique(array($own, $user1['user_id'], $user2['user_id'], $user3['user_id'], $user4['user_id'], $user5['user_id']));
		$six = array(
			'person1' => $user1,
			'person2' => $user2,
			'person3' => $user3,
			'person4' => $user4,
			'person5' => $user5,
			'person6' => $user6
		);
		return $six;
	}
	
	public function make_sure_unique($ids)
	{
		$temp_profile = $this->user_profiles->get_random_user_profile();
		while (in_array($temp_profile['user_id'], $ids))
		{
			$temp_profile = $this->user_profiles->get_random_user_profile();
		}
		return $temp_profile;
	}

	public function ajax_profiles()
	{
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		$data['profiles'] = $this->get_six_profiles();
		$this->load->view('show_profiles', $data);
	}
}