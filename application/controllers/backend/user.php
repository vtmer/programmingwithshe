<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

require_once 'auth.php';

class User extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'model');
    }

    /*
     * /backend/user
     *
     * 显示所有 user 条目
     */
    function index()
    {
        $data = $this->model->get();
        $this->twig->display('backend/user.html', array(
            'cur' => 'user',
            'data' => $data
        ));
    }

    function get_by_id($id)
    {
        $data = $this->model->get_by_id($id);
        $this->twig->display('backend/edit_user.html', array(
            'cur' => 'user',
            'data' => $data
        ));
    }
}
