<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matches extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','common_functions_helper'));
		$this->load->library('form_validation');
		$this->load->model('user_profiles');
		$this->load->model('admin_model');
	}

	public function index()
	{
		if($this->user_profiles->is_admin()){
			$data['user'] = $this->_matched_users(1);
			$data['usr_logged_in'] = $this->session->userdata('logged_in');
			$this->load->view('common/header_admin');
	    	$this->load->view('matches_page', $data);
			$this->load->view('common/footer');
		}
		elseif ($this->session->userdata('logged_in'))
		{
			$data['user'] = $this->_matched_users(1);
			$data['usr_logged_in'] = $this->session->userdata('logged_in');
			$this->load->view('common/header');
		    $this->load->view('matches_page', $data);
			$this->load->view('common/footer');
		}
		else
		{
			redirect('auth');
		}
	}

	public function ajax_matches($pagenumber)
	{
		$data['user'] = $this->_matched_users($pagenumber);
		$this->load->view('show_matches', $data);
	}
	
	public function _matched_users($pgnr)
	{
		$matches1 = $this->user_profiles->get_users_matching_pref(); //Get the users that match the pref
		$matches2 = $this->_assign_ranking($matches1);
		usort($matches2, "sort_users");
		$matches3 = $this->_get_right_page($matches2, $pgnr);
		return $matches3;
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
	
	public function _get_right_page($array, $pgnr)
	{
		$length = count($array);
		if ((($pgnr - 1) * 6) > $length)
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