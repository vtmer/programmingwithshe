<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

require_once 'auth.php';

class Tutor extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tutor_model');
    }

    /*
     * /backend/tutor
     *
     * 显示所有 tutor 条目
     */
    public function index()
    {
        $data = $this->tutor_model->get();
        $this->twig->display('backend/index.html', array('cur' => 'tutor', 'data' => $data));
    }

    /*
     * /backend/tutor/:id
     *
     * 根据 :id 来显示单条 tutor，
     * 同时提供修改表单
     */
    public function get_tutor_by_id($id)
    {
        $data = $this->tutor_model->get_by_id($id);

        if (empty($data))
        {
            show_404();
        }
        else
        {
            $this->index();
        }
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
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('create_tutor','content','required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('add_tutor');
        }
        else
        {
            $content = $this->input->post('create_tutor');
            $this->tutor_model->create_tutor($content);
            redirect('backend/tutor','refresh');
        }
    }
    
}
