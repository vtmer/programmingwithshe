<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

/*
 * Content_model
 *
 * content 表超类，提供关于 content 这个辅助表的
 * 相关操作。要使用的 model 应该 extends 这个超类。
 *
 */
class Content_model extends CI_Model
{
    /* 模型的表名 */
    protected $model_tb_name = '';
    /* content 表的表名 */
    protected $content_tb_name = 'content';
    /* content 外键键名 */
    protected $content_field_name = 'content_id';

    /*
     * get_content
     *
     * 根据 `id` 获取 content 的值。
     *
     * @param int id content 表中主键
     * @return string content
     */
    public function get_content($id)
    {
        $this->db->select('content')->from($this->content_tb_name);
        $query = $this->db->where('id', $id)->get();
        if ($query->num_rows()) {
            $result = $query -> result_array();
            return $result[0]['content'];
        }
        return 0;
    }

    /*
     * create_content
     *
     * 创建一条新的 `content`，
     * 创建成功，返回 `id`, 失败返回 0。
     *
     * @param string content
     * @return int content.id
     */
    public function create_content($content)
    {
        $data = array(
            'content' => $content
        );
        $this->db->insert($this->content_tb_name, $data);

        $this->db->select_max('id');
        $query = $this->db->get($this->content_tb_name);
        if ($query->num_rows()) {
            $result = $query -> result_array();
            return $result[0]['id'];
        }
        return 0;
    }

    /*
     * remove_content
     *
     * 删除一条`content`,
     *
     * @param int id
     */
    function remove_content($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->content_tb_name);
    }

    /*
     * edit_content
     *
     * 更新content 中内容
     *
     * @param int id
     * @param array data
     */
    function edit_content($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->content_tb_name, $data);
    }

    /*
     * get_content_id
     *
     * 根据表中主键获取 content_id 外键
     * @param int id
     * @return int content_id 如果不存在，则返回 0
     */
    function get_content_id($id)
    {
        $this->db->where('id', $id);
        $this->db->select($this->content_field_name);
        $query = $this->db->get($this->model_tb_name);
        if ($query->num_rows() === 0)
            return 0;
        return $query->result_array()[0][$this->content_field_name];
    }
}
