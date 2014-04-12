<?php 
class User_profiles extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_alpha()
	{
		$this->db->where('id',  1);
		$query = $this->db->get('algorithm');
		$data = array_shift(array_values($query->result_array()));
		return $data['alpha'];
	}
	
	function get_xfactor()
	{
	
	}
	
	function get_distance_measure()
	{
	
	}
	
	function get_alpha()
	{
	
	}
	
	function get_xfactor()
	{
	
	}
	
	function get_distance_measure()
	{
	
	}
	
}
?>