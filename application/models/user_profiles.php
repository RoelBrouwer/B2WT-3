<?php 
class User_profiles extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_random_user_profile()
	{
		//nickname, geslacht, leeftijd, beschrijving (eerste zin), persoonlijkheidstype, merkvoorkeuren
		$this->db->order_by('user_id', 'RANDOM');
		$this->db->limit(1);
		$query = $this->db->get('users');
		return $query->result_array();
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
	
	}
	
	function get_photo_by_id($id)
	{
	
	}
	
	function get_brandpref_by_id($id)
	{
	
	}
	
}	
?>