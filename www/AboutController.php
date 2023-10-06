<?php 

include_once "ApiController.php";
class AboutController extends ApiController{

    protected function do_get(){
        global $_CONTEXT;
        $page = 'AboutView.php';
        include '_layout.php';
    }

}