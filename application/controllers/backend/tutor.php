<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Tutor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tutor_model', 'model');
    }

    /*
     * /backend/tutor
     *
     * 显示所有 tutor 条目
     */
    public function index()
    {
        $this->twig->display('backend/index.html', array('cur' => 'tutor'));
    }

    /*
     * /backend/tutor/:id
     *
     * 根据 :id 来显示单条 tutor，
     * 同时提供修改表单
     */
    public function get_tutor_by_id($id)
    {
    }

    /*
     * /backend/tutor/:id
     *
     * 根据 :id 来删除单条 tutor
     */
    public function remove_tutor_by_id($id)
    {
    }

    /*
     * /backend/tutor/create
     *
     * 添加新的 tutor
     */
    public function create_tutor()
    {
    }
}
