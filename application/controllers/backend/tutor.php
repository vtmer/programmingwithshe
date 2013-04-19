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
        $this->twig->display('backend/tutor.html', array(
            'cur' => 'tutor',
            'data' => $data
        ));
    }

    /*
     * /backend/tutor/:id
     *
     * 根据 :id 来显示单条 tutor，
     * 同时提供修改表单
     */
    public function get_tutor_by_id($id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array(
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required|xss_clean'
            )
        ));
        $attr = array(
            'class' => 'editor',
            'id' => 'form'
        );
        $form = form_open(site_url('backend/tutor/' . $id), $attr);
        $data = $this->tutor_model->get_by_id($id, true);

        if ($this->form_validation->run() === false)
        {
            $this->twig->display('backend/edit.html', array(
                'cur' => 'tutor',
                'data' => $data,
                'form' => $form
            ));
        }
        else
        {
            $update_data = $this->input->post();
            $this->tutor_model->edit_tutor($id, $update_data);
            redirect('backend/tutor','refresh');
        }


    }

    /*
     * /backend/tutor/:id
     *
     * 根据 :id 来删除单条 tutor
     */
    public function remove_tutor_by_id($id)
    {
        $this->load->helper('url');
        $this->tutor_model->remove_tutor_by_id($id);
        redirect('backend/tutor', 'refresh');
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
        $this->form_validation->set_rules(array(
            array(
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required|xss_clean'
            )
        ));
        $attr = array(
            'class' => 'editor',
            'id' => 'form'
        );
        $form = form_open(site_url('backend/tutor/create'), $attr);

        if ($this->form_validation->run() === FALSE)
        {
            $this->twig->display('backend/create.html', array(
                'cur' => 'tutor',
                'form' => $form
            ));
        }
        else
        {
            $data = $this->input->post();
            $this->tutor_model->create_tutor($data);
            redirect('backend/tutor','refresh');
        }
    }
    
}
