<?php
class Solution_model extends CI_model{

    public function __construct(){
        $this->load->database();
    }

    public function set_content($content)
    {
        $data = array(
            'content' => $content
        );
        $this->db->insert('content',$data);
    }

    public function get_all_content() 
    {
        $query = $this->db->get('content');
        return $query->result_array();
    }

    public function get_max_id()
    {
         $query = $this->db->select_max('id');
         $row = $this->db->get('content')->row_array();
         return $row['id'];
    }


    public function set_solution($source_id)
    {
        $data = array(
            'source_id' => $source_id
        );
        $this->db->insert('solution',$data);
    }



}
