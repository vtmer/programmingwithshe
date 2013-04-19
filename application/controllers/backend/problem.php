<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

require_once 'auth.php';

class Problem extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('problem_model');
    }


    /*
     * /backend/problem
     *
     * 显示所有problem 条目
     */
    function index()
    {
        $data = $this->problem_model->get();
        $this->twig->display('backend/problem.html', array(
            'cur' => 'problem',
            'data' => $data
        ));
    }


    /*
     * /backend/problem/:id
     *
     * 根据 ：id 来显示单条 problem
     * 同时提供修改表单
     */
    function get_problem_by_id($id)
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
        $form = form_open(site_url('backend/problem/' . $id), $attr);
        $data = $this->problem_model->get_by_id($id, true);

        if ($this->form_validation->run() === false) {
            $this->twig->display('backend/edit.html',array(
                'cur' => 'problem',
                'data' => $data,
                'form' => $form
            ));
        } else {
            $update_data = $this->input->post();
            $this->problem_model->edit_problem($id, $update_data);
            redirect('backend/problem', 'refresh');
        }
    }


    /*
     * /backend/problem/:id/remove
     *
     * 根据 :id 来删除单条problem
     */
    function remove_problem_by_id($id)
    {
        $this->problem_model->remove_problem_by_id($id);
        redirect('backend/problem', 'refresh');
    }


    /*
     *  /backend/problem/create
     *
     *  添加新的 problem
     */
    function create_problem()
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
        $form = form_open(site_url('backend/problem/create'), $attr);

        if ($this->form_validation->run() === false)
        {
            $this->twig->display('backend/create.html', array(
                'cur' => 'problem',
                'form' => $form
            ));
        } else {
            $data = $this->input->post();
            $this->problem_model->create_problem($data);
            redirect('backend/problem', 'refresh');
        }
    }
}
