<?php defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH.'/libraries/REST_Controller.php';

class problem_api extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('problem_model');
	}

	function content_id_get()
	{
		
		$check=$this->problem_model->get_content_id($this->get('id'));
		if($check)
		{
			$this->response($check,200);
		}
		else
		{
			$this->response(array('error' => 'User could not be found'), 404);
		}
	}


	function get_by_id()
	{
		$check=$this->problem_model->get_id_id($this->get('id'),true);
	}
}



?>