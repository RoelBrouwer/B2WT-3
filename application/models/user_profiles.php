<?php 
class User_profiles extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->helper('common_functions_helper');
    }
    
    function get_random_user_profile()
	{
		//nickname, geslacht, leeftijd, beschrijving (eerste zin), persoonlijkheidstype, merkvoorkeuren
		$this->db->order_by('user_id', 'RANDOM');
		$this->db->limit(1);
		$query = $this->db->get('users');
		$user = array_shift(array_values($query->result_array()));
		$user['personality'] = get_personality_string($this->get_personalitytype_by_id($user['user_id']));
		$user['brandpref'] = $this->get_brandpref_by_id($user['user_id']);
		return $user;
	}
	
	function get_user_by_nickname()
	{
		
		$this->db->where('nickname',  $this->session->userdata('nickname'));
		$query = $this->db->get('users');
		$data = array_shift(array_values($query->result_array()));
		$data['personality'] = get_personality_string($this->get_personalitytype_by_id($data['user_id']));
		$data['brandpref'] = $this->get_brandpref_by_id($data['user_id']);
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
	
	function update_user($data)
	{
		if (($this->input->post('username') != $data['nickname']) && $this->is_unique('nickname',$this->input->post('username')))
		{ 
			$changes['nickname'] = $this->input->post('username');
		}
		
		if ($this->input->post('password') != '') 
		{ 
			$changes['password'] = md5($this->input->post('password'));
		}
		
		if (($this->input->post('email') != $data['email']) && $this->is_unique('email',$this->input->post('email')))
		{ 
			$changes['email'] = $this->input->post('email');
		}
		
		if ($this->input->post('first_name') != $data['firstname']) 
		{
			$changes['firstname'] = $this->input->post('first_name');
		}
		
		if ($this->input->post('last_name') != $data['lastname']) 
		{ 
			$changes['lastname'] = $this->input->post('last_name');
		}
		
		if ($this->input->post('birthdate') != $data['birthdate']) 
		{ 
			$changes['birthdate'] = $this->input->post('birthdate');
		}
		
		if ($this->input->post('gender') != $data['sex']) 
		{ 
			$changes['sex'] = $this->input->post('gender');
		}
		
		if ($this->input->post('description') != $data['description']) 
		{ 
			$changes['description'] = $this->input->post('description');
		}
		
		if ($this->input->post('gender_pref') != $data['sexpref']) 
		{ 
			$changes['sexpref'] = $this->input->post('gender_pref');
		}
		
		if ($this->input->post('min_age') != $data['minage']) 
		{ 
			$changes['minage'] = $this->input->post('min_age');
		}
		
		if ($this->input->post('max_age') != $data['maxage']) 
		{ 
			$changes['maxage'] = $this->input->post('max_age');
		}
		if (isset($changes))
		{
			$this->db->where('user_id', $data['user_id']);
			$this->db->update('users', $changes);
		}
	}
	
	public function is_unique($field, $str) {
        $this->db->where($field, $str);
		$query = $this->db->get('users');
		if ($query->num_rows() === 0)
		{
			return true;
		}
		else
		{
			return false;
		}
    }
	
}	
?>