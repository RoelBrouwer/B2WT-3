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
		$data['text'] = "<h2>Mijn likes</h2> Hieronder vind je een overzicht van alle gebruikers die je ge-liked hebt. ";
		$data['profiles'] = $this->_get_right_page($this->likes_model->get_users_i_liked(), 1);
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
		$this->load->view('mylikes_page', $data);
		$this->load->view('common/footer');
	}
	
	public function liked_me() {
		$data['text'] = "<h2>Wie liket mij?</h2> Hieronder vind je een overzicht van alle gebruikers die jou ge-liked hebben. ";
		$data['profiles'] = $this->_get_right_page($this->likes_model->get_users_liked_me(), 1);
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
		$this->load->view('likedme_page', $data);
		$this->load->view('common/footer');
	}
	
	public function match() {
		$data['text'] = "<h2>Matches</h2> Hieronder vind je een overzicht van alle gebruikers die je ge-liked hebt en die jou ook ge-liked hebben: gebruikers waarmee de likes matchen!";
		$data['profiles'] = $this->_get_right_page($this->likes_model->get_likes_mutual(), 1);
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
		$this->load->view('mutuallikes_page', $data);
		$this->load->view('common/footer');
	}

	public function ajax_likedme($pg)
	{
		$data['profiles'] = $this->_get_right_page($this->likes_model->get_users_liked_me(), $pg);
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		$this->load->view('show_profiles', $data);
	}

	public function ajax_mylikes($pg)
	{
		$data['profiles'] = $this->_get_right_page($this->likes_model->get_users_i_liked(), $pg);
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		$this->load->view('show_profiles', $data);
	}

	public function ajax_mutallikes($pg)
	{
		$data['usr_logged_in'] = $this->session->userdata('logged_in');
		$data['profiles'] = $this->_get_right_page($this->likes_model->get_likes_mutual(), $pg);
		$this->load->view('show_profiles', $data);
	}
	
	public function _get_right_page($array, $pgnr)
	{
		$length = count($array);
		if (((($pgnr - 1) * 6) > $length))
		{
			return null;
		}
		if (($length - ($pgnr * 6)) >= 0)
		{
			//Geef precies zes profielen terug
			$resultscount = 6;
		}
		else
		{
			$resultscount = ($length % 6);
		}
		$resultarray = array();
		if ($resultscount > 0)
		{
			for ($i = 0; $i < $resultscount; $i++)
			{
				$norm = 6 * ($pgnr - 1);
				array_push($resultarray, $array[($norm + $i)]);
			}
			return $resultarray;
		}
		else
		{
			return null;
		}
	}
	
}
