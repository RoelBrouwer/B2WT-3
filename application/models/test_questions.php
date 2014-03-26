<?php 
class Test_questions extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_questions()
    {
        $query = $this->db->get('questions', 10);
        return $query->result();
    }

}
?>