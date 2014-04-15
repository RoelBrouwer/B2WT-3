<?php 
class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_alpha()
	{
		$this->db->where('algorithm_id',  1);
		$query = $this->db->get('algorithm');
		$data = array_shift(array_values($query->result_array()));
		return $data['alfa'];
	}
	
	function get_xfactor()
	{
		$this->db->where('algorithm_id',  1);
		$query = $this->db->get('algorithm');
		$data = array_shift(array_values($query->result_array()));
		return $data['xfactor'];
	}
	
	function get_distance_measure()
	{
		$this->db->where('algorithm_id',  1);
		$query = $this->db->get('algorithm');
		$data = array_shift(array_values($query->result_array()));
		return $data['distance_measure'];
	}
	
	function set_alpha($alpha)
	{
		$changes['alfa'] = $alpha;
		$this->db->where('algorithm_id',  1);
		$this->db->update('algorithm', $changes);
	}
	
	function set_xfactor($xfactor)
	{
		$changes['xfactor'] = $xfactor;
		$this->db->where('algorithm_id',  1);
		$this->db->update('algorithm', $changes);
	}
	
	function set_distance_measure($distance_measure)
	{
		$changes['distance_measure'] = $distance_measure;
		$this->db->where('algorithm_id',  1);
		$this->db->update('algorithm', $changes);
	}
	
}
?>