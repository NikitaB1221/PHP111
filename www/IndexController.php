<?php

include_once "ApiController.php";

class IndexController extends ApiController
{
    protected function do_get() {
        $this->log_error("m: " . __METHOD__ . " | l: " . __LINE__ . " | error: GET request detected");
        $page = 'IndexView.php';
        global $_CONTEXT;
        include '_layout.php';
    }
}


?>