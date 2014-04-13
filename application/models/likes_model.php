<?php 
class Likes_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function get_like($id)
	{
		$this->db->where('nickname',  $this->session->userdata('nickname'));
		$query = $this->db->get('users');
		$data = array_shift(array_values($query->result_array()));
		$this->db->where('user_id', $data['user_id']);
		$this->db->where('user_id_liked', $id);
		$query = $this->db->get('likes');
		if ($query->num_rows() === 0) {
			$melike = false;
		} else { melike = true; }
		$this->db->where('user_id', $id);
		$this->db->where('user_id_liked', $data['user_id']);
		$query = $this->db->get('likes');
		if ($query->num_rows() === 0) {
			$likeme = false;
		} else { $likeme = true; }
		if ($melike && $likeme) {
			return 4; } 
		if ($melike && !$likeme) {
			return 3; } 
		if (!$melike && $likeme) {
			return 2; }
		return 1;
	}
	
	public function add_like($id)
	{
		$this->db->where('nickname',  $this->session->userdata('nickname'));
		$query = $this->db->get('users');
		$data = array_shift(array_values($query->result_array()));
		$like = array (
			'user_id' => $data['user_id'],
			'user_id_liked' => $id
		);
		$this->db->insert('likes',$like);
	}
	
}
	