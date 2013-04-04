<?php
class Test_model extends CI_model{

    public function __construct(){
        $this->load->database();
    }

    public function set_content()
    {
        $data=array(
            'content'=>$this->input->post('content')
        );
        $this->db->insert('content',$data);
    }

    public function get_content($id=FALSE) 
    {
        $query=$this->db->get('content');
        return $query->result_array();
    }


    public function solution()
    {
        $query=$this->db->
    }



}
