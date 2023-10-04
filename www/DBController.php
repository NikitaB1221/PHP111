<?php 

include_once "ApiController.php";
class DBController extends ApiController{

    protected function do_get(){
        global $_CONTEXT;
        $page = 'DBView.php';
        include '_layout.php';
    }

}