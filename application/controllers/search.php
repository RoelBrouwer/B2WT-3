<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model(array('user_profiles','admin_model'));
		
		$this->form_validation->set_message('required','U bent vergeten uw %s in te voeren.');
		$this->form_validation->set_message('is_natural','De %s is te hoog.');
		$this->form_validation->set_message('less_than','De %s moet lager zijn dan 120.');
		$this->form_validation->set_message('check_ages','De gewenste maximumleeftijd moet groter zijn dan de gewenste minimumleeftijd.');
		
		$this->form_validation->set_rules('gender_pref', 'geslachtsvoorkeur', 'required');
		$this->form_validation->set_rules('min_age', 'gewenste minimumleeftijd', 'required|is_natural|less_than[120]');
		$this->form_validation->set_rules('max_age', 'gewenste maximumleeftijd', 'required|is_natural|less_than[120]|callback_check_ages['.$this->input->post('min_age').']');
		$this->form_validation->set_rules('extravert', 'persoonlijkheidsvoorkeur - Extravert', 'required|numeric|less_than[100]');
		$this->form_validation->set_rules('intuitive', 'persoonlijkheidsvoorkeur - Intuitive', 'required|numeric|less_than[100]');
		$this->form_validation->set_rules('thinking', 'persoonlijkheidsvoorkeur - Thinking', 'required|numeric|less_than[100]');
		$this->form_validation->set_rules('judging', 'persoonlijkheidsvoorkeur - Judging', 'required|numeric|less_than[100]');
		$this->form_validation->set_rules('brandpref', 'merkvoorkeuren', 'required');
	}

	function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			redirect('matches');
		}
		else
		{
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('test_questions');
				$data['brands'] = $this->test_questions->get_brands();
				$this->load->view('common/header_anon');
				$this->load->view('search_form', $data);
				$this->load->view('common/footer');
			}
			else
			{
				$data['usr_logged_in'] = $this->session->userdata('logged_in');
				$data['user'] = $this->_matched_users();
				$this->load->view('common/header_anon');
				$this->load->view('display_matches', $data);
				$this->load->view('common/footer');
			}
		}
	}
	
	function check_ages($max, $min)
	{
		return ($max > $min);
	}
	
	public function _matched_users()
	{
		$form_in = $this->input->post();
		$matches1 = $this->user_profiles->get_users_matching_pref_anon($form_in); //Get the users that match the pref
		$matches2 = $this->_assign_ranking($matches1);
		usort($matches2, "sort_users");
		return $matches2;
	}
	
	public function _assign_ranking($users)
	{
		$ranked_users = array();
		foreach ($users as $user)
		{
			$pers_dist = $this->_get_distance($user);
			$brands_dist = $this->_get_brands_distance($user);
			$xfactor = $this->admin_model->get_xfactor();
			$match_fact = ($xfactor * $pers_dist) + ((1 - $xfactor) * $brands_dist);
			array_push($ranked_users, array('rank' => $match_fact, 'user' => $user));
		}
		return $ranked_users;
	}
	
	public function _get_distance($user)
	{
		$curr_user = $this->input->post();
		$curr_user_pers = array('E' => 50, 'N' => 50, 'T' => 50, 'J' => 50); //Neutrale user
		$curr_user_pers_pref = array('E' => $curr_user['extravert'], 'N' => $curr_user['intuitive'], 'T' => $curr_user['thinking'], 'J' => $curr_user['judging']);
		$user_pers = $this->user_profiles->get_personalitytype_by_id($user['user_id']);
		$user_pers_pref = $this->user_profiles->get_personalitypref_by_id($user['user_id']);
		
		$distance1 = abs($curr_user_pers['E'] - $user_pers_pref['E']) + abs($curr_user_pers['N'] - $user_pers_pref['N']) + abs($curr_user_pers['T'] - $user_pers_pref['T']) + abs($curr_user_pers['J'] - $user_pers_pref['J']);
		$distance2 = abs($curr_user_pers_pref['E'] - $user_pers['E']) + abs($curr_user_pers_pref['N'] - $user_pers['N']) + abs($curr_user_pers_pref['T'] - $user_pers['T']) + abs($curr_user_pers_pref['J'] - $user_pers['J']);
		$distance = max($distance1, $distance2) / 400;
		return $distance;
	}
	
	public function _get_brands_distance($user)
	{
		$curr_user = $this->input->post();
		$curr_user_brands = $this->_normalize_input_brands($curr_user['brandpref']);
		$user_brands = $this->_normalize_brands_list($this->user_profiles->get_brandpref_by_id($user['user_id']));
		
		$distance_measure = $this->admin_model->get_distance_measure();
		switch ($distance_measure) {
			case 1: //Dice's coefficient
				$similarity = (2 * count(array_intersect($curr_user_brands, $user_brands))) / (count($curr_user_brands) + count($user_brands));
				break;
			case 2: //Jaccard's coefficient
				$similarity = (count(array_intersect($curr_user_brands, $user_brands))) / (count(array_unique(array_merge($curr_user_brands, $user_brands))));
				break;
			case 3: //Cosine coefficient
				$similarity = (count(array_intersect($curr_user_brands, $user_brands))) / (sqrt(count($curr_user_brands)) * sqrt(count($user_brands)));
				break;
			case 4: //Overlap coefficient
				$similarity = (count(array_intersect($curr_user_brands, $user_brands))) / (min(count($curr_user_brands), count($user_brands)));
				break;
		}
		return (1 - $similarity);
		
	}
	
	public function _normalize_brands_list($brands)
	{
		$ret = array();
		foreach ($brands as $b)
		{
			array_push($ret, $b['name']);
		}
		return $ret;
	}
	
	public function _normalize_input_brands($brands)
	{
		$ret = array();
		foreach ($brands as $b)
		{
			$n = $this->user_profiles->get_brandname_by_id($b);
			array_push($ret, $n);
		}
		return $ret;
	}
}