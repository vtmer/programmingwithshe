<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'model');
        $this->load->helper('url');
    }

    /*
     * /backend/login
     *
     */
    function login()
    {
        /* 检查用户是否已经登录 */
        $this->load->helper('form');
        $token = $this->input->cookie('token');
        $username = $this->input->cookie('username');
        if ($this->model->is($username, $token))
            redirect('/', 'refresh');

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array(
                'field' => 'username',
                'label' => 'Username:',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'password',
                'label' => 'Password:',
                'rules' => 'required|xss_clean'
            )
        ));

        if ($this->form_validation->run() === false) {
            $attrs = array(
                'class' => 'form-horizontal'
            );
            $config = array(
                'form' => form_open('backend/login', $attrs)
            );
            $this->twig->display('login.html', $config);
        } else {
            /* 登录成功 */
            $info = $this->input->post();
            if ($this->model->check_password($info['username'], $info['password'])) {
                $token = $this->model->update_token($info['username']);
                $this->input->set_cookie(array(
                    'name' => 'token',
                    'value' => $token,
                    'expire' => 365 * 24 * 3600,
                    'path' => '/'
                ));
                $this->input->set_cookie(array(
                    'name' => 'username',
                    'value' => $info['username'],
                    'expire' => 365 * 24 * 3600,
                    'path' => '/'
                ));
                redirect('/', 'refresh');
            } else {
                /* 登录失败 */
                $config = array(
                    'error' => 'Username or password incorrect'
                );
                $this->twig->display('login.html', $config);
            }
        }
    }

    /*
     * /backend/logout
     *
     */
    function logout()
    {
        $this->input->set_cookie(array(
            'name' => 'token',
            'value' => '',
            'expire' => -1
        ));
        $this->input->set_cookie(array(
            'name' => 'username',
            'value' => '',
            'expire' => -1
        ));
        /* TODO redirect to next parameter */
        redirect('/', 'location');
    }
}
