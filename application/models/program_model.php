<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class program_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function show_problem()
    {
        $this->db->select('content');
        $this->db->from('content');
        $this->db->join('problem','content_id = content.id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function add_problem()
    {
        $new_content = $this->input->post('add_problem');
        $data = array(
            'content' => $new_content
        );
        $this->db->insert('content',$data);

        $this->db->select_max('id');
        $query = $this->db->get('content');
        $result = $query->row_array();

        $data = array(
            'content_id' => $result['id'] 
        );
        $this->db->insert('problem',$data);
    }

    public function show_tutor()
    {
    }

    public function add_tutor()
    {
    }

    public function show_user()
    {
    }


}
