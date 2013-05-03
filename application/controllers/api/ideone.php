<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once REST;
require_once APPPATH . '/libraries/Ideone.php';

/*
 * Ideone_Controller
 *
 * 使用 ideone 提供的 api 运行用户提交的代码
 *
 */
class Ideone extends REST_Controller
{
    private $api;

    function __construct()
    {
        parent::__construct();
        $this->api = new IdeoneAPI();
    }

    /*
     * /api/run
     *
     * 执行用户提交的代码
     */
    function index_post()
    {
        $code = $this->post('code');
        $submit = $this->api->submit($code);

        if ($submit['error'] === 'OK') {
            $result = $this->api->result($submit['link']);
        } else {
            $result = array(
                'result' => $submit['result']
            );
        }
        $this->response($result);
    }
}
