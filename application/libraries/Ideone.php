<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * IdeoneAPI
 * 
 * 提供 ideone 的 api 调用
 *
 */
class IdeoneAPI
{
    private $CI;
    private $api_uri = 'http://ideone.com/api/1/service.wsdl';
    private $client;
    private $user;
    private $password;
    private $lang_id = 11;  // C
    private $detail_result = array(
        0 => 'Success',
        1 => 'Compiled',
        3 => 'Running',
        11 => 'Compilation Error',
        12 => 'Runtime Error',
        13 => 'Timelimit exceeded',
        15 => 'Success',
        17 => 'memory limit exceeded',
        19 => 'illegal system call',
        20 => 'internal error'
    );

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->config->load('ideone');
        $this->user = $this->CI->config->item('ideone_user');
        $this->password = $this->CI->config->item('ideone_password');
        $this->client = new SoapClient($this->api_uri);
    }

    /*
     * submit
     *
     * 向 ideone 提交一份代码
     * @param str code
     * @param str input
     * @return array error (OK 为提交成功，否则为失败) & link
     */
    public function submit($code, $input='')
    {
        $result = $this->client->createSubmission($this->user, $this->password,
            $code, $this->lang_id, $input, True, True);
        return $result;
    }

    /*
     * result
     * 
     * 根据 $link 来获取 ideone 执行结果
     * @param   str     link
     * @return  array   result 为 OK 则获取正常，否则为获取有问题 
     *
     * TODO get submission status timeout
     *
     */
    public function result($link)
    {
        do {
            $status = $this->client->getSubmissionStatus(
                $this->user, $this->password, $link);
            if ($status['status'] != 0)
                sleep(3);
        } while ($status['status'] != 0);
        $detail = $this->client->getSubmissionDetails(
            $this->user, $this->password, $link,
            False,  // without source
            False,  // without input
            True,   // with output
            True,   // with stderr
            True    // with compile infos
        );
        if ($detail['error'] === 'OK') {
            $result = array(
                'result' => 'OK',
                'time' => $detail['result'],
                'memory' => $detail['memory'],
                'signal' => $detail['signal'],
                'detail' => $this->detail_result[$detail['result']],
                'stderr' => $detail['stderr'],
                'cmpinfo' => $detail['cmpinfo'],
                'output' => $detail['output']
            );
        } else {
            $result = array(
                'result' => 'ERROR'
            );
        }
        return $result;
    }
}
