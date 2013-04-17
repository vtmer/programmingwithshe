<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowoe');

require_once "content_model.php";

class Solution_model extends Content_model
{
    protected $model_tb_name = 'solution';

    /*
     * get
     * 获取一定条目的 solution
     *
     * @param int limit
     * @param bool load_content  
     * @return 查询 result_array
     */
    function get($limit = 0, $load_content = false)
    {
        $this->db->from($this->model_tb_name);
        if ($limit)
            $this->db->limit($limit);
        if ($load_content)
            $this->db->join($this->content_tb_name, 'content.id = source_id');
        $query = $this->db->get();
        return $query->result_array();
    }
}
