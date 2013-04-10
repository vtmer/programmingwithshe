<?php

class Backend extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('program_model');
    }

    public function index()
    {
    }

    public function show_problem()
    {
        $this->load->view('header');
        $result = $this->program_model->show_problem();
        foreach ($result as $result_item)
            echo $result_item['content'];
        $this->load->view('footer');
    }

    public function add_problem()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('add_problem','problem','required');
        if( $this->form_validation->run()===FALSE)
        {
            $this->load->view('header');
            $this->load->view('add_problem');
            $this->load->view('footer');
        }
        else
        {
            $this->program_model->add_problem();
            $this->load->view('header');
            $this->load->view('success');
            $this->load->view('footer');
        }
    }

    public function add_tutor()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('add_tutor','Tutor','required');
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('header');
            $this->load->view('add_tutor');
            $this->load->view('footer');
        }
        else
        {
            $this->program_model->add_tutor();
            $this->load->view('header');
            $this->load->view('success');
            $this->load->view('footer');
        }
    }

    public function show_tutor()
    {
        $this->load->view('header');
        $result = $this->program_model->show_tutor();
        foreach ($result as $result_item)
            echo $result_item['content'];
        $this->load->view('footer');
    }
}
?>
