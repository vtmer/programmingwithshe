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
            return $query->result_array()[0]['content'];
        }
        return '';
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
            return $query->row_array()[0]['id'];
        }
        return 0;
    }
}
