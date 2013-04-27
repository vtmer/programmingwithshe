<?php defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH.'/libraries/REST_Controller.php';

class tutor_api extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('problem_model');
	}

	/*根据获取的limit的值来决定获取的tutor的条数
	 *
	 *运用model中的get()方法
	 *获取的数据返回浏览器
	 */

	function tutors_get()
	{
		$check=$this->problem_model->get($this->get('limit'),false);
if
		($check)
			$this->response($check,200);
		else
			$this->response(array('error' =>'problem could not be found'),404);
	}



	/*根据id获取单条的tutor
	 *
	 *根据content_id获取单条content
	 *
	 *response
	 */
	function tutor_get()
	{
		$check=$this->problem_model->get_by_id($this->get('id'),true);
		if($check)
		{
			$data['problem']=$check;

			$check=$this->problem_model->get_content_id($this->get('content_id'));
			$data['content']=$check;

			$this->response($data,200);
		}
		else
			$this->response(array('error' =>'this problem could not be found'),404);
	}

}



?>