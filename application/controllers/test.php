<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

require_once APPPATH . '/libraries/Ideone.php';

class Test extends CI_Controller
{
    private $api;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('solution_model', 'model');
        $this->api = new IdeoneAPI();
    }

    function create_solution()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array(
                'field' => 'content',
                'label' => 'Code',
                'rules' => 'required'
            )
        ));
        $form = form_open(site_url('test/code'));

        if ($this->form_validation->run() === false) {
            $this->twig->display('test/code.html', array(
                'form' => $form
            ));
        } else {
            $code = $this->input->post('content');
            $this->model->create(array('content' => $code));
            $submit = $this->api->submit($code);

            if ($submit['error'] === 'OK') {
                $result = $this->api->result($submit['link']);
            } else {
                $result = array(
                    'result' => $submit['result']
                );
            }
            var_dump($result);
        }
    }
}
