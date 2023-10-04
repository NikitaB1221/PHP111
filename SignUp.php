<?php 
include_once "ApiController.php";
class SignUpCOntroller extends ApiController{
    protected function do_get(){
        global $_CONTEXT;
        $page = "forms.php";
        include '_layout.php';

    }

    protected function do_post(){

    }

    private function check_ssesion() {
        if (isset($_SESSION['form_data'])) {
            if ($_SESSION['reg_db'] !== true) {
                $db_message = $_SESSION['reg_db'];
            } else {
                $db_message = "Insert OK";
            }
            if (isset($_SESSION['$name_message'])) {
                $name_message = $_SESSION['$name_message'];
                unset($_SESSION['$name_message']);
            }
            if (isset($_SESSION['$lastname_message'])) {
                $lastname_message = $_SESSION['$lastname_message'];
                unset($_SESSION['$lastname_message']);
            }
            if (isset($_SESSION['$email_message'])) {
                $email_message = $_SESSION['$email_message'];
                unset($_SESSION['$email_message']);
            }
            if (isset($_SESSION['$telephone_message'])) {
                $telephone_message = $_SESSION['$telephone_message'];
                unset($_SESSION['$telephone_message']);
            }
            if (isset($_SESSION['$avatar_message'])) {
                $avatar_message = $_SESSION['$avatar_message'];
                unset($_SESSION['$avatar_message']);
            }
            unset($_SESSION['form_data']);
            $reg_name = $_SESSION['reg_name'];
            $reg_lastname = $_SESSION['reg_lastname'];
            $reg_email = $_SESSION['reg_email'];
            $reg_telephone = $_SESSION['reg_telephone'];
            $reg_avatar = $_SESSION['reg_avatar'];
        }
    }
}