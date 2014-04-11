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
	
	function get_personalitytype_by_id()
	{
	
	}
	
	function get_photo_by_id()
	{
	
	}
	
	function get_merkvoorkeuren_by_id()
	{
	
	}
	
?>