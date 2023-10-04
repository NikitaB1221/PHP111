<?php
include_once "ApiController.php";
class ShopController extends ApiController{

    protected function do_get(){
        global $_CONTEXT;
        $page = 'ShopView.php';
        include '_layout.php';
    }

}