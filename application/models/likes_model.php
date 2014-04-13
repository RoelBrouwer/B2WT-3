<?php 
class Likes_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user_profiles');
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
		} else { $melike = true; }
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
		if($data['user_id'] != $id) {
			$like = array (
				'user_id' => $data['user_id'],
				'user_id_liked' => $id
			);
			$this->db->insert('likes',$like);
			$this->user_profiles->change_personality_pref($data['user_id'],$id);
		}
	}
	
	public function get_users_liked_me()
	{
		$curr_user = $this->user_profiles->get_user_by_nickname();
		//$this->db->select('user_id');
		$this->db->where('user_id_liked', $curr_user['user_id']);
		$this->db->from('likes');
		$this->db->join('users', 'likes.user_id = users.user_id');
		$query = $this->db->get();
		$result = $query->result_array();
		$ret = array();
		foreach ($result as $usr)
		{
			$usr['personality'] = get_personality_string($this->user_profiles->get_personalitytype_by_id($usr['user_id']));
			$usr['perspref'] = get_personality_string($this->user_profiles->get_personalitypref_by_id($usr['user_id']));
			$usr['brandpref'] = $this->user_profiles->get_brandpref_by_id($usr['user_id']);
			$usr['photo'] = $this->user_profiles->get_photo_by_id($usr['user_id']);
			$usr['like'] = $this->user_profiles->get_like_status($usr['user_id']);
			array_push($ret, $usr);
		}
		return $ret;
	}
	
	public function get_users_i_liked()
	{
		$curr_user = $this->user_profiles->get_user_by_nickname();
		$this->db->where('likes.user_id', $curr_user['user_id']);
		$this->db->from('likes');
		$this->db->join('users', 'likes.user_id_liked = users.user_id');
		$query = $this->db->get();
		$result = $query->result_array();
		$ret = array();
		foreach ($result as $usr)
		{
			$usr['personality'] = get_personality_string($this->user_profiles->get_personalitytype_by_id($usr['user_id']));
			$usr['perspref'] = get_personality_string($this->user_profiles->get_personalitypref_by_id($usr['user_id']));
			$usr['brandpref'] = $this->user_profiles->get_brandpref_by_id($usr['user_id']);
			$usr['photo'] = $this->user_profiles->get_photo_by_id($usr['user_id']);
			$usr['like'] = $this->user_profiles->get_like_status($usr['user_id']);
			array_push($ret, $usr);
		}
		return $ret;
	}
	
	public function get_likes_mutual()
	{
		$i_liked = $this->get_users_i_liked();
		$mutual = array();
		foreach ($i_liked as $like)
		{
			$like['user_id'];
			$curr_user = $this->user_profiles->get_user_by_nickname();
			$this->db->where('user_id_liked', $curr_user['user_id']);
			$this->db->where('user_id', $like['user_id']);
			$query = $this->db->get('likes');
			if ($query->num_rows() == 1)
			{
				array_push($mutual, $like);
			}
		}
		$ret = array();
		foreach ($mutual as $usr)
		{
			$usr['personality'] = get_personality_string($this->user_profiles->get_personalitytype_by_id($usr['user_id']));
			$usr['perspref'] = get_personality_string($this->user_profiles->get_personalitypref_by_id($usr['user_id']));
			$usr['brandpref'] = $this->user_profiles->get_brandpref_by_id($usr['user_id']);
			$usr['photo'] = $this->user_profiles->get_photo_by_id($usr['user_id']);
			$usr['like'] = $this->user_profiles->get_like_status($usr['user_id']);
			array_push($ret, $usr);
		}
		return $ret;
	}
	
}
	