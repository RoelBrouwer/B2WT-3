<?php 
class Login extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function able_login()
    {
		$this->db->where('nickname', strtolower($this->input->post('username')));
		$this->db->where('password',  md5($this->input->post('password')));
        $query = $this->db->get('users');
		$confirmed = $query->row();
		if (($query->num_rows() == 1) && ($confirmed->confirmed == 1))
		{
			return true;
		}
		else
		{
			return false;
		}
    }
	
	public function add_temp_user($key)
	{
		$data = array (
			'nickname' => strtolower($this->input->post('username')),
			'firstname' => $this->input->post('first_name'),
			'lastname' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'photo_id' => 0,   //Hier moeten we nog iets mee
			'sex' => $this->input->post('gender'),
			'birthdate' => $this->input->post('birthdate'),
			'description' => $this->input->post('description'),
			'sexpref' => $this->input->post('gender_pref'),
			'personality_id' => 0, 
			'personalpref' => 0,
			'minage' => $this->input->post('min_age'),
			'maxage' => $this->input->post('max_age'),
			'admin' => 0,
			'regdate' => date('Y-m-d'),
			'key' => $key,
			'confirmed' => 0
		);
		
		$query = $this->db->insert('users',$data);
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function check_key($key)
	{
		$this->db->where('key', $key);
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function add_user($key)
	{
		$this->db->where('key', $key);
		$temp_user = $this->db->get('users');
		if ($temp_user)
		{
			$this->db->set('confirmed', 1, FALSE);
			$this->db->where('key', $key);
			$this->db->update('users');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function personality_type($key)
	{
		$this->load->helper('common_functions_helper');
		$form_in = $this->input->post();
		$type_occ = array_count_values(array($form_in['q1'],$form_in['q2'],$form_in['q3'],$form_in['q4'],$form_in['q5'],$form_in['q6'],$form_in['q7'],$form_in['q8'],$form_in['q9'],$form_in['q10'],$form_in['q11'],$form_in['q12'],$form_in['q13'],$form_in['q14'],$form_in['q15'],$form_in['q16'],$form_in['q17'],$form_in['q18'],$form_in['q19']));
		$types = array('E', 'I', 'N','S', 'T', 'F', 'J', 'P');
		foreach ($types as $type) {
			if (!isset($type_occ[$type]))
			{
				$type_occ[$type] = 0;
			}
		}
		
		$extravert = 50 + (10 * $type_occ['E']) - (10 * $type_occ['I']);
		$intuitive = 50 + (12.5 * $type_occ['N']) - (12.5 * $type_occ['S']);
		$thinking = 50 + (12.5 * $type_occ['T']) - (12.5 * $type_occ['F']);
		$judging = 50 + ((50/6) * $type_occ['J']) - ((50/6) * $type_occ['P']);
		
		$data = get_personality_string(array('E' => $extravert, 'N' => $intuitive, 'T' => $thinking, 'J' => $judging));
		
		$qdata = array (
			'E' => round($extravert, 1),
			'N' => round($intuitive, 1),
			'T' => round($thinking, 1),
			'J' => round($judging, 1)
		);
		
		$query = $this->db->insert('personalities',$qdata);
		
		$id_n = $this->db->insert_id();
		
		$this->db->set('personality_id', $id_n, FALSE);
		$this->db->where('key', $key);
		$this->db->update('users');
		
		$qbdata = array (
			'E' => round((100 - $extravert), 1),
			'N' => round((100 - $intuitive), 1),
			'T' => round((100 - $thinking), 1),
			'J' => round((100 - $judging), 1)
		);
		
		$query2 = $this->db->insert('personalities',$qbdata);
		
		$id_n2 = $this->db->insert_id();
		
		$this->db->set('personalpref', $id_n2, FALSE);
		$this->db->where('key', $key);
		$this->db->update('users');
		
		return $data;
	}
	public function brand_preference($key)
	{
		$form_input = $this->input->post();
		
		$this->db->select('user_id');
		$this->db->where('key', $key);
		$query = $this->db->get('users');
		$cq = array_shift(array_values($query->result_array()));
		foreach ($form_input['brandpref'] as $b)
		{
			$brandp = array (
				'user_id' => $cq['user_id'],
				'brand_id' => $b
			);
			$this->db->insert('brandpref',$brandp);
		}
	}
	
}
?>