<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

require_once "content_model.php";

class Tutor_model extends Content_model
{
    protected $model_tb_name = 'tutor';

    /*
     * get_by_id
     *
     * 根据 id 获取单条 tutor
     *
     * @param int id
     * @return 查询 result_array
     */
    public function get_by_id($id)
    {
        $this->db->from($this->model_tb_name)->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     * get
     *
     * 获取一定数目的 tutor
     *
     * @param int   limit           指定条数，0 为获取所有条目
     * @param bool  load_content    是否同时获取 content
     * @return 查询 result_array
     */
    public function get($limit = 0, $load_content = false)
    {
        $this->db->from($this->model_tb_name);
        if ($limit)
            $this->db->limit($limit);
        if ($load_content)
            $this->db->join($this->content_tb_name,
                            $this->content_field_name . ' = content.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     *remove_by_id
     *
     * 根据 id 删除单条 tutor
     *
     * @param int id
     * @return 查询 result_array
     */
    function remove_by_id($id)
    {
        $this->db->from($this->model_tb_name)->where('id', $id);
        $query = $this->db->delete();
        return $query->result_array();
    }

    /*
     *create_tutor
     *
     * 增加 tutor
     *
     * @param string content
     */
    function create_tutor($content)
    {
        /* 将 content_id 插入到 tutor 表中*/
        $content_id = $this->create_content($content);
        $data = array('content_id' => $content_id);
        $this->db->insert($this->model_tb_name, $data);
    }

    /*
     * edit_tutor
     *
     * 修改 tutor
     *
     * @param data
     */
    function edit_tutor($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->model_tb_name,$data);
    }
}
