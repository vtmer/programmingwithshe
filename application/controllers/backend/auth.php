<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

/*
 * Auth_Controller
 *
 * 提供用户验证功能
 * 如果用户没有登录，跳转到登录页面
 *
 */
class Auth_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin_model', 'admin_model');

        $token = $this->input->cookie('token');
        $username = $this->input->cookie('username');
        if (!$this->admin_model->is($username, $token))
            redirect(site_url() . '/backend/login?next=' . current_url(),
                     'location');
    }
}
