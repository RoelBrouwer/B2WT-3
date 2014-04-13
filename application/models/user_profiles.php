<?php 
class User_profiles extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->helper('common_functions_helper');
		$this->load->model('admin_model');
    }
    
    function get_random_user_profile()
	{
		//nickname, geslacht, leeftijd, beschrijving (eerste zin), persoonlijkheidstype, merkvoorkeuren
		$this->db->order_by('user_id', 'RANDOM');
		$this->db->limit(1);
		$query = $this->db->get('users');
		$user = array_shift(array_values($query->result_array()));
		$user['personality'] = get_personality_string($this->get_personalitytype_by_id($user['user_id']));
		$user['perspref'] = get_personality_string($this->get_personalitypref_by_id($user['user_id']));
		$user['brandpref'] = $this->get_brandpref_by_id($user['user_id']);
		$user['photo'] = $this->get_photo_by_id($user['user_id']);
		if ($this->session->userdata('logged_in')){
			$data['user'] = $this->get_like_status($user['user_id']);
		}
		return $user;
	}
	
	function get_user_by_nickname()
	{
		$this->db->where('nickname',  $this->session->userdata('nickname'));
		$query = $this->db->get('users');
		$data = array_shift(array_values($query->result_array()));
		$data['personality'] = get_personality_string($this->get_personalitytype_by_id($data['user_id']));
		$data['perspref'] = get_personality_string($this->get_personalitypref_by_id($data['user_id']));
		$data['brandpref'] = $this->get_brandpref_by_id($data['user_id']);
		$data['photo'] = $this->get_photo_by_id($data['user_id']);
		$data['like'] = $this->get_like_status($data['user_id']);
		return $data;
	}
	
	function get_user_by_id($id)
	{
		$this->db->where('user_id',  $id);
		$query = $this->db->get('users');
		$data = array_shift(array_values($query->result_array()));
		$data['personality'] = get_personality_string($this->get_personalitytype_by_id($id));
		$data['perspref'] = get_personality_string($this->get_personalitypref_by_id($id));
		$data['brandpref'] = $this->get_brandpref_by_id($id);
		$data['photo'] = $this->get_photo_by_id($id);
		if ($this->session->userdata('logged_in')){
			$data['like'] = $this->get_like_status($id);
		}
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
	
	function get_personalitypref_by_id($id)
	{
		$this->db->select('personalpref');
		$this->db->where('user_id', $id);
		$query = $this->db->get('users');
		$pers_id = array_shift(array_values($query->result_array()));
		$this->db->where('personality_id', $pers_id['personalpref']);
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
		if ((($this->input->post('username') != $data['nickname']) && $this->is_unique('nickname',$this->input->post('username'))) && $this->input->post('username') != '')
		{ 
			$changes['nickname'] = $this->input->post('username');
		}
		
		if ($this->input->post('password') != '') 
		{ 
			$changes['password'] = md5($this->input->post('password'));
		}
		
		if ((($this->input->post('email') != $data['email']) && $this->is_unique('email',$this->input->post('email'))) && $this->input->post('username') != '')
		{ 
			$changes['email'] = $this->input->post('email');
		}
		
		if (($this->input->post('first_name') != $data['firstname']) && $this->input->post('first_name') != '')
		{
			$changes['firstname'] = $this->input->post('first_name');
		}
		
		if (($this->input->post('last_name') != $data['lastname']) && $this->input->post('last_name') != '')
		{ 
			$changes['lastname'] = $this->input->post('last_name');
		}
		
		if (($this->input->post('birthdate') != $data['birthdate']) && $this->input->post('birthdate') != '')
		{ 
			$changes['birthdate'] = $this->input->post('birthdate');
		}
		
		if (($this->input->post('gender') != $data['sex']) && $this->input->post('gender') != '')
		{ 
			$changes['sex'] = $this->input->post('gender');
		}
		
		if (($this->input->post('description') != $data['description']) && $this->input->post('description') != '')
		{ 
			$changes['description'] = $this->input->post('description');
		}
		
		if (($this->input->post('gender_pref') != $data['sexpref']) && $this->input->post('gender_pref') != '')
		{ 
			$changes['sexpref'] = $this->input->post('gender_pref');
		}
		
		if (($this->input->post('min_age') != $data['minage']) && $this->input->post('min_age') != '')
		{ 
			$changes['minage'] = $this->input->post('min_age');
		}
		
		if (($this->input->post('max_age') != $data['maxage']) && $this->input->post('max_age') != '')
		{ 
			$changes['maxage'] = $this->input->post('max_age');
		}
		if (isset($changes))
		{
			$this->db->where('user_id', $data['user_id']);
			$this->db->update('users', $changes);
		}
	}
	
	public function update_brandspref()
	{
		$data = $this->get_user_by_nickname();
		$form_input = $this->input->post();		
		if (isset($form_input['brandpref'])) {
		
			foreach ($data['brandpref'] as $bref) {
				$check = false;
				foreach ($form_input['brandpref'] as $bfi) {
					if ($bref['name']==$bfi['name']){$check = true;}
				}
				if(!$check){
					$this->db->where('name', $bref['name']);
					$query = $this->db->get('brands');
					$getid = array_shift(array_values($query->result_array()));
					
					$this->db->where('user_id', $data['user_id']);
					$this->db->where('brand_id', $getid['brand_id']);
					$this->db->delete('brandpref');
				}
			}
		
			foreach ($form_input['brandpref'] as $b)
			{
				$this->db->where('user_id', $data['user_id']);
				$this->db->where('brand_id', $b);
				$query = $this->db->get('brandpref');
				if ($query->num_rows() === 0) {
					$brandp = array (
						'user_id' => $data['user_id'],
						'brand_id' => $b
					);
					$this->db->insert('brandpref',$brandp);
				}
			}
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
	
	public function get_users_matching_pref()
	{
		$curr_user = $this->get_user_by_nickname();		
		if ($curr_user['sexpref'] != 'B')
		{
			$this->db->where('sex', $curr_user['sexpref']);
		}
		$min = $this->get_date_from_age($curr_user['minage']);
		$max = $this->get_date_from_age($curr_user['maxage']);
		$this->db->where('birthdate <=', $min);
		$this->db->where('birthdate >=', $max);
		$this->db->where('user_id !=', $curr_user['user_id']);
		$query = $this->db->get('users');
		$result = $query->result_array();
		$ret = array();
		foreach ($result as $usr)
		{
			$usr['personality'] = get_personality_string($this->get_personalitytype_by_id($usr['user_id']));
			$usr['perspref'] = get_personality_string($this->get_personalitypref_by_id($usr['user_id']));
			$usr['brandpref'] = $this->get_brandpref_by_id($usr['user_id']);
			$usr['photo'] = $this->get_photo_by_id($usr['user_id']);
			$usr['like'] = $this->get_like_status($usr['user_id']);
			array_push($ret, $usr);
		}
		return $ret;
	}
	
	public function get_users_matching_pref_anon($curr_user)
	{
		if ($curr_user['gender_pref'] != 'B')
		{
			$this->db->where('sex', $curr_user['gender_pref']);
		}
		$min = $this->get_date_from_age($curr_user['min_age']);
		$max = $this->get_date_from_age($curr_user['max_age']);
		$this->db->where('birthdate <=', $min);
		$this->db->where('birthdate >=', $max);
		$query = $this->db->get('users');
		$result = $query->result_array();
		$ret = array();
		foreach ($result as $usr)
		{
			$usr['personality'] = get_personality_string($this->get_personalitytype_by_id($usr['user_id']));
			$usr['perspref'] = get_personality_string($this->get_personalitypref_by_id($usr['user_id']));
			$usr['brandpref'] = $this->get_brandpref_by_id($usr['user_id']);
			$usr['photo'] = $this->get_photo_by_id($usr['user_id']);
			array_push($ret, $usr);
		}
		return $ret;
	}
	
	public function get_date_from_age($age)
	{
		$years = mktime(0,0,0,date("m"),date("d"),(date("Y")-$age));
		return date("Y-m-d", $years);
	}
	
	public function delete_user()
	{
		$this->db->where('nickname',  $this->session->userdata('nickname'));
		$query = $this->db->delete('users');
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
					
	}
	
	public function is_admin()
	{
		$this->db->where('nickname',  $this->session->userdata('nickname'));
		$query = $this->db->get('users');
		$data = array_shift(array_values($query->result_array()));
		return $data['admin'];
	}
	
	public function get_brandname_by_id($id)
	{
		$this->db->where('brand_id', $id);
		$query = $this->db->get('brands');
		$data = array_shift(array_values($query->result_array()));
		return $data['name'];
	}
	
	public function get_like_status($id)
	{
		$this->load->model('likes_model');
		return $this->likes_model->get_like($id); //Not implemented yet
	}
	
	public function change_personality_pref($liking,$liked) 
	{
		$liking_pref = $this->get_personalitypref_by_id($liking);
		$liked_pers = $this->get_personalitytype_by_id($liked);
		$alpha = $this->admin_model->get_alpha();
		$new_pref['E'] = ($alpha * $liking_pref['E']) + ((1 - $alpha) * $liked_pers['E']);
		$new_pref['N'] = ($alpha * $liking_pref['N']) + ((1 - $alpha) * $liked_pers['N']);
		$new_pref['T'] = ($alpha * $liking_pref['T']) + ((1 - $alpha) * $liked_pers['T']);
		$new_pref['J'] = ($alpha * $liking_pref['J']) + ((1 - $alpha) * $liked_pers['J']);
		$uss = $this->get_user_by_id($liking);
		$this->db->where('personality_id', $uss['personalpref']);
		$this->db->update('personalities', $new_pref);
	}
}	
?>