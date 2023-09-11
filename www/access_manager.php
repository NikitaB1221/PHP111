<?php
$uri = $_SERVER['REQUEST_URI'];  //
if($uri == 'index'){
    include 'index.php';  #
}
else{
    echo 'access manager - 404' ;
}