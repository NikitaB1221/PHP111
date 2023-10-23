<?php
include_once "ApiController.php";
class SignUpController extends ApiController
{
    protected function do_get()
    {
        global $_CONTEXT;
        $view_data = [
            'reg-name' => [
                'class' => 'validate',
                'value' => '',
                'error' => false,
            ],
            'reg-lastname' => [
                'class' => 'validate',
                'value' => '',
                'error' => false,
            ],
            'reg-phone' => [
                'class' => 'validate',
                'value' => '',
                'error' => false,
            ],
            'reg-email' => [
                'class' => 'validate',
                'value' => '',
                'error' => false,
            ],
            'reg-avatar' => [
                'class' => 'validate',
                'value' => '',
                'error' => false,
            ],
        ];
        $this->check_session($view_data);
        $page = "forms.php";
        include '_layout.php';

    }

    protected function do_post()
    {
        $db = $this->get_db();
        if (!isset($_POST['reg-name'])) {
            $name_message = "No reg-name field";
        } else {
            $reg_name = $_POST['reg-name'];
            if (strlen($reg_name) < 2) {
                $name_message = "Name too short";
            }
        }

        if (!isset($_POST['reg-lastname'])) {
            $lastname_message = "No reg-lastname field";
        } else {
            $reg_lastname = $_POST['reg-lastname'];
            if (strlen($reg_name) < 2) {
                $lastname_message = "Login too short";
            } else {
                $sql = "SELECT COUNT(*) FROM users u WHERE u.`login` = ?";
                try {
                    $prep = $db->prepare($sql);
                    $prep->execute([$reg_lastname]);
                    $cnt = $prep->fetch(PDO::FETCH_NUM)[0];
                    if ($cnt != 0) {
                        $lastname_message = 'Login in use';
                    }
                } catch (PDOException $ex) {
                    $this->log_error("m: " . __METHOD__ . " | l: " . __LINE__ . " | error: " . $ex->getMessage());
                    $this->send_error(500);
                }
            }
        }
        $_SESSION['form_data'] = true;
        $_SESSION['reg_db'] = false;
        $_SESSION['reg_name'] = $reg_name;
        $_SESSION['reg_lastname'] = $reg_lastname;

        if (isset($_FILES['reg-avatar'])) {
            if (
                $_FILES['reg-avatar']['error'] == 0
                && $_FILES['reg-avatar']['size'] > 0
            ) {

                $uploadDir = "E:/PHP/www/img/";
                $extension = pathinfo(
                    $_FILES['reg-avatar']['name'],
                    PATHINFO_EXTENSION
                );

                do {
                    $uniqueFileName = uniqid() . '.' . $extension;
                    $uploadPath = "{$uploadDir}/{$uniqueFileName}";
                } while (file_exists($uploadPath));

                move_uploaded_file(
                    $_FILES['reg-avatar']['tmp_name'],
                    $uploadPath
                );
            }
        }



        $is_valid = true;
        if (isset($name_message)) {
            $_SESSION['name_message'] = $name_message;
            $is_valid = false;
        }
        if (isset($lastname_message)) {
            $_SESSION['lastname_message'] = $lastname_message;
            $is_valid = false;
        }
        if ($is_valid === false) {
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
        $salt = substr(md5(uniqid()), 0, 16);
        $dk = sha1($salt . md5($_POST['reg-phone']));
        $email = empty($_POST['reg-email'])
            ? "NULL"
            : "'{$_POST['reg-email']}'";

        $avatar = empty($uniqueFileName)
            ? "NULL"
            : "'{$uniqueFileName}'";

        $sql = "
			INSERT INTO users(`id`,`login`,`salt`,`pass_dk`,`name`,`email`,`avatar`)
			VALUES( UUID_SHORT(), '{$reg_lastname}', '{$salt}', '{$dk}', 
			'{$reg_name}', {$email}, {$avatar} )";
        try {
            $db->query($sql);
            $_SESSION['reg_db'] = true;
        } catch (PDOException $ex) {
            $this->log_error("m: " . __METHOD__ . " | l: " . __LINE__ . " | error: " . $ex->getMessage());
            $this->send_error(500);
        }
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    private function check_session(&$view_data)
    {
        if (isset($_SESSION['form_data'])) {
            // Загальна успішність:
            if ($_SESSION['reg_db'] !== true) {
                $db_message = $_SESSION['reg_db'];
            } else {
                $db_message = "INSERT OK";
            }
            // є передача даних, перевіряємо повідомлення
            if (isset($_SESSION['name_message'])) {
                $view_data['reg-name']['error'] = $_SESSION['name_message'];
                unset($_SESSION['name_message']);
            }
            if (isset($_SESSION['lastname_message'])) {
                $view_data['reg-lastname']['error'] = $_SESSION['lastname_message'];
                unset($_SESSION['lastname_message']);
            }
            if (isset($_SESSION['$email_message'])) {
                $view_data['reg-email']['error'] = $_SESSION['$email_message'];
                unset($_SESSION['$email_message']);
            }
            if (isset($_SESSION['$telephone_message'])) {
                $view_data['reg-phone']['error'] = $_SESSION['$telephone_message'];
                unset($_SESSION['$telephone_message']);
            }
            $view_data['reg-name']['value'] = $_SESSION['reg_name'];
            $view_data['reg-lastname']['value'] = $_SESSION['reg_lastname'];
            $view_data['reg-phone']['value'] = $_SESSION['reg_telephone'];
            $view_data['reg-email']['value'] = $_SESSION['reg_email'];

            // видаляємо з сесії повідомленя про дані
            unset($_SESSION['form_data']);
            unset($_SESSION['reg_db']);

            $view_data['reg-name']['class'] =
                $view_data['reg-name']['error'] === false
                ? "valid"
                : "invalid";
            $view_data['reg-lastname']['class'] =
                $view_data['reg-lastname']['error'] === false
                ? "valid"
                : "invalid";
            $view_data['reg-phone']['class'] =
                $view_data['reg-phone']['error'] === false
                ? "valid"
                : "invalid";
            $view_data['reg-email']['class'] =
                $view_data['reg-email']['error'] === false
                ? "valid"
                : "invalid";
        }

    }
}