<?php
class Program extends CI_Controller {
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('test_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index()
    {
    }


    public function setContent()
    {
        $this->form_validation->set_rules('content','content','required');
        if($this->form_validation->run()===FALSE)
        {
            $this->load->view('setContent');
            $this->load->view('footer');
        }
        else
        {
            $this->test_model->set_content();
            $this->load->view('header');
            $this->load->view('success');
        }
            
    }
}
?>
