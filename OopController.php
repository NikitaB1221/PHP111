<?php

include_once "ApiController.php";

class OopController extends ApiController
{
    private $var;

    public function __construct($var = 10) {
        $this->var = $var;
    }

    protected function do_get() {
        $this->log_error("m: " . __METHOD__ . " | l: " . __LINE__ . " | error: GET request detected");
        $page = 'OopView.php';
        global $_CONTEXT;
        include '_layout.php';
    }

    protected function do_post() {
        echo 'POST requests';
    }

    protected function do_put() {
        echo 'PUT requests';
    }

    protected function do_link() {
        echo 'LINK requests';
    }
}


?>