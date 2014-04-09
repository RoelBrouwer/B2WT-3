<?php 
class Test_questions extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_questions()
    {
        $query = $this->db->get('questions');
		$quest = $query->result_array();
		foreach ($quest as &$q) {
			//get answers
			$this->db->where('question_tag', $q['question_tag']);
			$qa = $this->db->get('answers');
			$q['answers'] = $qa->result_array();
		}
        return $quest;
    }
}
?>