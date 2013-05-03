<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowoe');

require_once "content_model.php";

class Solution_model extends Content_model
{
    protected $model_tb_name = 'solution';
    protected $content_field_name = 'source_id';

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

    /*
     * create
     *
     * 添加 
     *
     * @param array data
     */
    function create($data)
    {
        $content = $data['content'];
        $content_id = $this->create_content($content);
        $data = array(
            'source_id' => $content_id
        );
        $this->db->insert($this->model_tb_name, $data);
    }

    /*
     * remove_by_id
     *
     * 根据 id 删除一条记录
     *
     * @param int id
     */
    function remove_by_id($id)
    {
        $content_id = $this->get_content_id($id);
        $this->remove_content($content_id);
        $this->db->where('id', $id);
        $this->db->delete($this->model_tb_name);
    }
}
