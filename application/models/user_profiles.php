<?php 
class User_profiles extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_random_user_profile()
	{
		$this->load->helper('common_functions_helper');
		//nickname, geslacht, leeftijd, beschrijving (eerste zin), persoonlijkheidstype, merkvoorkeuren
		$this->db->order_by('user_id', 'RANDOM');
		$this->db->limit(1);
		$query = $this->db->get('users');
		$user = array_shift(array_values($query->result_array()));
		$user['personality'] = get_personality_string($this->get_personalitytype_by_id($user['id']));
		$user['brandpref'] = $this->get_brandpref_by_id($user['id']);
		return $user;
	}
	
	function get_user_by_nickname()
	{
		
		$this->db->where('nickname',  $this->session->userdata('nickname'));
		$query = $this->db->get('users');
		$data = array_shift(array_values($query->result_array()));
		return $data;
	}
	
	function get_personalitytype_by_id($id)
	{
		$this->db->select('personality_id');
		$this->db->where('user_id', $id);
		$query = $this->db->get('users');
		$pers_id = array_shift(array_values($query->result_array()));
		$this->db->where('personality_id', $pers_id['personality_id']);
		$query2 = $this->db->get('personalities');
		return array_shift(array_values($query2->result_array()));
	}
	
	function get_photo_by_id($id)
	{
	
	}
	
	function get_brandpref_by_id($id)
	{
		$this->db->select('name');
		$this->db->where('user_id', $id);
		$this->db->from('brandpref');
		$this->db->join('brands', 'brands.brand_id = brandpref.brand_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	
}	
?>