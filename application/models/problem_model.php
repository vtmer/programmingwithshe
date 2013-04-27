<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed' );

require_once "content_model.php";

class Problem_model extends Content_model
{
    protected $model_tb_name = 'problem';


    /*
     * get_content_id
     *
     * 由 problem表主键得到content表主键
     * @param int id
     */
    function get_content_id($id)
    {
        $this->db->where('id', $id);
        $this->db->select('content_id');
        $query = $this->db->get($this->model_tb_name);
        $result = $query -> result_array();
        var_dump($result);
        return 1;
        //return $result[0]['content_id'];
    }


    /*
     * get_by_id
     *
     * 根据id获取单条problem
     *
     * @param int    id   
     * @param bool load_content  
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
     * 获取一定数目的problem
     *  
     *  @ param int     limit              指定获取条数，0为获取所有条目
     *  @ param bool    load_content       是否同时获取content
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
     * create_problem
     *
     * 添加 problem
     *
     * @param string data
     */
    function create_problem($data)
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
     

    /*remove_by_id
     * 根据 id 删除单条 problem
     *
     * @param int id
     * @return 查询 result_array()
     */
    function remove_problem_by_id($id)
    {
        $content_id = $this->get_content_id($id);
        $this->remove_content($content_id);
        $this->db->where('id', $id);
        $this->db->delete($this->model_tb_name);
    }

    
    /*
     * edit_problem
     *
     * 修改 problem
     * @param int id
     * @param array data
     */
    function edit_problem($id, $data)
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
    
}
