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
		if ($query->num_rows() == 1)
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
			'password' => md5($this->input->post('password')),
			'photo_id' => 1,   //Hier moeten we nog iets mee
			'sex' => $this->input->post('gender'),
			'birthdate' => $this->input->post('birthdate'),
			'sexpref' => $this->input->post('gender_pref'),
			'personality_id' => 1, //Ook nog niet functioneel
			'personalpref' => 1, //Niet functioneel
			'minage' => $this->input->post('min_age'),
			'maxage' => $this->input->post('max_age'),
			'admin' => 0,
			'regdate' => date('Y-m-d'),
			'key' => $key
		);
		
		$query = $this->db->insert('temp_users',$data);
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
		$query = $this->db->get('temp_users');
		
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
		$temp_user = $this->db->get('temp_users');
		if ($temp_user)
		{
			$row = $temp_user->row();
			$data = array(
				'nickname' => $row->nickname,
				'firstname' => $row->firstname,
				'lastname' => $row->lastname,
				'email' => $row->email,
				'password' => $row->password,
				'photo_id' => $row->photo_id,
				'sex' => $row->sex,
				'birthdate' => $row->birthdate,
				'sexpref' => $row->sexpref,
				'personality_id' => $row->personality_id,
				'personalpref' => $row->personalpref,
				'minage' => $row->minage,
				'maxage' => $row->maxage,
				'admin' => $row->admin,
				'regdate' => $row->regdate
			);
			
			$user = $this->db->insert('users',$data);
			
			if ($user)
			{
				$this->db->where('key', $key);
				$this->db->delete('temp_users');
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	public function personality_type($key)
	{
		$form_in = $this->input->post();
		$type_occ = array_count_values($form_in);
		$types = array('E', 'I', 'N','S', 'T', 'F', 'J', 'P');
		foreach ($types as $type) {
			if (!isset($type_occ[$type]))
			{
				$type_occ[$type] = 0;
			}
		}
		$extravert = 50 + (10 * $type_occ['E']) - (10 * $type_occ['I']);
		if ($extravert >= 50) {
			$ei = "Extravert: " . $extravert . "%";
			$data['type'] = "E";
		}
		else {
			$ei = "Introvert: " . (100 - $extravert) . "%";
			$data['type'] = "I";
		}
		$intuitive = 50 + (12.5 * $type_occ['N']) - (12.5 * $type_occ['S']);
		if ($intuitive >= 50) {
			$ns = "Intuitive: " . $intuitive . "%";
			$data['type'] = $data['type'] . "N"; 
		}
		else {
			$ns = "Sensing: " . (100 - $intuitive) . "%";
			$data['type'] = $data['type'] . "S"; 
		}
		$thinking = 50 + (12.5 * $type_occ['T']) - (12.5 * $type_occ['F']);
		if ($thinking >= 50) {
			$tf = "Thinking: " . $thinking . "%";
			$data['type'] = $data['type'] . "T"; 
		}
		else {
			$tf = "Feeling: " . (100 - $thinking) . "%";
			$data['type'] = $data['type'] . "F"; 
		}
		$judging = 50 + ((50/6) * $type_occ['J']) - ((50/6) * $type_occ['P']);
		if ($judging >= 50) {
			$jp = "Judging: " . $judging . "%";
			$data['type'] = $data['type'] . "J"; 
		}
		else {
			$jp = "Percieving: " . round((100 - $judging), 1) . "%";
			$data['type'] = $data['type'] . "P"; 
		}
		$data['percentage'] = $ei . "<br />" . $ns . "<br />" . $tf . "<br />" . $jp;
		
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
		$this->db->update('temp_users');
		
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
		$this->db->update('temp_users');
		
		return $data;
	}
	
}
?>