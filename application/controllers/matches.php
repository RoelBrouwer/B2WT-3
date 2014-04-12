<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matches extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','common_functions_helper'));
		$this->load->library('form_validation');
		$this->load->model('user_profiles');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$data['user'] = $this->_matched_users(); //array(1,2,3); //array of users
			$this->load->view('common/header');
			$this->load->view('display_matches', $data);
			$this->load->view('common/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	public function _matched_users()
	{
		$matches1 = $this->user_profiles->get_users_matching_pref(); //Get the users that match the pref
		$this->_assign_ranking($matches1);
		return $matches1;
	}
	
	public function _assign_ranking($users)
	{
		foreach ($users as $user)
		{
			$pers_dist = $this->_get_distance($user);
			$brands_dist = $this->_get_brands_distance($user);
		}
	}
	
	public function _get_distance($user)
	{
		$curr_user = $this->user_profiles->get_user_by_nickname();
		$curr_user_pers = $this->user_profiles->get_personalitytype_by_id($curr_user['user_id']);
		$curr_user_pers_pref = $this->user_profiles->get_personalitypref_by_id($curr_user['user_id']);
		$user_pers = $this->user_profiles->get_personalitytype_by_id($user['user_id']);
		$user_pers_pref = $this->user_profiles->get_personalitypref_by_id($user['user_id']);
		
		$distance1 = abs($curr_user_pers['E'] - $user_pers_pref['E']) + abs($curr_user_pers['N'] - $user_pers_pref['N']) + abs($curr_user_pers['T'] - $user_pers_pref['T']) + abs($curr_user_pers['J'] - $user_pers_pref['J']);
		$distance2 = abs($curr_user_pers_pref['E'] - $user_pers['E']) + abs($curr_user_pers_pref['N'] - $user_pers['N']) + abs($curr_user_pers_pref['T'] - $user_pers['T']) + abs($curr_user_pers_pref['J'] - $user_pers['J']);
		$distance = max($distance1, $distance2) / 400;
		return $distance;
	}
	
	public function _get_brands_distance($user)
	{
		$curr_user = $this->user_profiles->get_user_by_nickname();
		$curr_user_brands = $this->_normalize_brands_list($this->user_profiles->get_brandpref_by_id($curr_user['user_id']));
		$user_brands = $this->_normalize_brands_list($this->user_profiles->get_brandpref_by_id($user['user_id']));
		
		$distance_measure = 1; //TODO: Get form database!
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
		echo $similarity;
		//aantal: count()
		//union: array_unique(array_merge($curr_user_brands, $user_brands))
		//intersection: array_intersect($curr_user_brands, $user_brands)
		
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

}