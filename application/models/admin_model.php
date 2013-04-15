<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    private $tb_name = 'admin';

    private function encrypt($raw)
    {
        return sha1($raw);
    }

    /*
     * create
     *
     * 创建一个用户
     *
     * @param string name
     * @param string password
     */
    function create($name, $password)
    {
        $cond = array(
            'name' => $name,
            'password' => $this->encrypt($password)
        );
        $this->db->insert($this->tb_name, $cond);
    }

    /*
     * check_password
     *
     * 验证用户名和密码是否匹配
     *
     * @param string name
     * @param string password
     * @return bool
     */
    function check_password($name, $password)
    {
        $cond = array(
            'name' => $name,
            'password' => $this->encrypt($password)
        );
        $query = $this->db->get_where($this->tb_name, $cond);

        return !($query->result() === array());
    }

    /*
     * update_password
     *
     * 更新用户密码
     *
     * @param string name
     * @param string password
     */
    function update_password($name, $password)
    {
        $this->db->update($this->tb_name,
                          array('password' => $this->encrypt($password)),
                          array('name' => $name));
    }

    /*
     * update_token
     *
     * 更新用户 token
     *
     * @param string name
     * @return string generated token
     */
    function update_token($name)
    {
        $salt = $this->config->item('encryption');
        $token = $this->encrypt($name . time() . $salt);
        $this->db->update($this->tb_name, array('token' => $token),
                          array('name' => $name));
        return $token;
    }

    /*
     * is
     *
     * 验证用户和 token 是否匹配
     *
     * @param string name
     * @param string token
     * @return bool
     */
    function is($name, $token)
    {
        $cond = array(
            'name' => $name,
            'token' => $token
        );
        $query = $this->db->get_where($this->tb_name, $cond);
        
        return !($query->result() === array());
    }

    function get_by_token($token)
    {
        $cond = array(
            'token' => $token
        );
        $query = $this->db->get_where($this->tb_name, $cond);
        return $query->result_array();
    }
}
