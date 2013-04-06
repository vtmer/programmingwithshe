<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once REST;

class API extends REST_Controller {
    public function index_get() {
        $this->response(array(1, 2, 3));
    }

    public function book_get($id) {
        $this->response(array($id));
    }

    public function book_post($id) {
        $this->response(array($id + 12));
    }
}
