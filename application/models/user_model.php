<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $tb_name = 'user';

    private function encrypt($raw)
    {
        return sha1($raw);
    }

    /*
     * create
     *
     * 创建新的用户记录
     *
     * @return string session_id
     */
    function create()
    {
        $data = array(
            'session_id' => $this->encrypt(time())
        );
        $this->db->insert($this->tb_name, $data);
        return $data['session_id'];
    }

    /*
     * update
     *
     * 根据 session_id 更新用户记录信息
     *
     * @param string session_id
     * @param array data
     */
    function update($session_id, $data)
    {
        $this->db->update($this->tb_name, $data)
                 ->where(array('session_id' => $session_id));
    }

    /*
     * get_by_id
     *
     * 根据 id 获取一条记录
     *
     * @param int id
     * @return array result_array
     */
    function get_by_id($id)
    {
        $this->db->from($this->tb_name)->where('id', $id);
        $query = $this->db->get();
        $ret = $query->result_array();
        if ($ret)
            $ret = $ret[0];
        return $ret;
    }

    /*
     * get
     *
     * 获取一定数目记录
     *
     * @param int limit 0 表示获取全部
     * @return array result_array
     */
    function get($limit = 0)
    {
        $this->db->from($this->tb_name);
        if ($limit)
            $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
}
