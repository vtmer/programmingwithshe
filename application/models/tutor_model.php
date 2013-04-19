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
     * @param int   id              id 为 tutor 表主键
     * @param bool  load_content    是否获取内容
     * @return 查询 result_array
     */
    function get_by_id($id, $load_content = false)
    {
        $this->db->from($this->model_tb_name)->where('id', $id);
        $query = $this->db->get();
        $ret = $query->result_array();
        if ($ret)
            $ret = $ret[0];
        if ($load_content && $ret['content_id'])
            $ret['content'] = $this->get_content($ret['content_id']);
        return $ret;
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
    function get($limit = 0, $load_content = false)
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
     *remove_tutor_by_id
     *
     * 根据 id 删除单条 tutor
     *
     * @param int id
     * id 为 tutor 表主键
     * @return 查询 result_array
     */
    function remove_tutor_by_id($id)
    {
        $content_id = $this->get_content_id($id);
        $this->remove_content($content_id);
        $this->db->where('id', $id);
        $this->db->delete($this->model_tb_name);
    }

    /*
     * create_tutor
     *
     * 增加 tutor
     *
     * @param string data
     */
    function create_tutor($data)
    {
        /* 将 content_id 插入到 tutor 表中*/
        $content = $data['content'];
        $content_id = $this->create_content($content);
        $data = array(
            'content_id' => $content_id,
            'title' => $data['title']
        );
        $this->db->insert($this->model_tb_name, $data);
    }

    /*
     * edit_tutor
     *
     * 修改 tutor
     * id 为 tutor 表主键
     *
     * @param int id
     * @param array data
     */
    function edit_tutor($id,$data)
    {
        $content = array(
            'content' => $data['content']
        );
        $title = array(
            'title' => $data['title']
        );

        $content_id = $this->get_content_id($id);
        $this->edit_content($content_id, $content);
        $this->db->where('id', $id);
        $this->db->update($this->model_tb_name, $title);
    }

    /*
     * get_content_id
     *
     * 
     * 由tutor 表主键得到content 表中的主键
     * @param int id  
     * id 为 tutor 表主键
     * 
     * return content_id
     * content_id 为content表的主键
     */
    function get_content_id($id)
    {
        $this->db->where('id',$id);
        $this->db->select('content_id');
        $query = $this->db->get($this->model_tb_name);
        $result = $query -> result_array();
        return $result[0]['content_id'];
    }
}
