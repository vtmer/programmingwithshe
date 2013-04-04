<?php
class Program extends CI_Controller {
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('solution_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
    }


    public function setContent()
    {
        $content = $this->input->post('content');
        $this->form_validation->set_rules('content','content','required');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('setContent');
            $this->load->view('footer');
        }
        else
        {
            $this->solution_model->set_content($content);
            $source_id = $this->solution_model->get_max_id();
            $this->solution_model->set_solution($source_id);
            $this->load->view('header');
            $this->load->view('success');
        }
            
    }

}
?>
