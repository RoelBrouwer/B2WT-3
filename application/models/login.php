<?php 
class Login extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function able_login()
    {
		$this->db->where('nickname', $this->input->post('username'));
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
			'nickname' => $this->input->post('username'),
			'firstname' => $this->input->post('first_name'),
			'lastname' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'photo_id' => 1,   //Hier moeten we nog iets mee
			'sex' => $this->input->post('gender'),
			'birthdate' => $this->input->post('birthdate'),
			'sexpref' => $this->input->post('gender_pref'),
			'personality_id' => 1, //Ook nog niet functioneel
			'minage' => $this->input->post('min_age'),
			'maxage' => $this->input->post('max_age'),
			'admin' => 0,
			'regdate' => date('d-m-Y'),
			'key' => $key
		);
		
		$query = $this->db->insert('temp_user',$data);
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
		$query = $this->db->get('temp_user');
		
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
		$temp_user = $this->db->get('temp_user');
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
				'personalitypref' => 1, //Niet functioneel - Iets van een functie hier aanroepen die de persoonlijkheid uit personality_id inverteert
				'minage' => $row->minage,
				'maxage' => $row->maxage,
				'admin' => $row->admin,
				'regdate' => $row->regdate
			);
			
			$user = $this->db->insert('user',$data);
			
			if ($user)
			{
				$this->db->where('key', $key);
				$this->db->delete('temp_user');
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
}
?>