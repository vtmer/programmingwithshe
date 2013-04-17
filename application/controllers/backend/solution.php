<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

require_once 'auth.php';

class Solution extends Auth_Controller
{
    function  __construct()
    {
        parent::__construct();
        $this->load->model('solution_model');
    }


    /*
     * /backend/solution
     *
     * 显示所有solution条目
     */
    function index()
    {
        $data = $this->solution_model->get();
        $this->twig->display('backend/solution.html', array(
            'cur' => 'solution',
            'data' => $data
        ));
    }
}
