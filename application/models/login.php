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
}
?>