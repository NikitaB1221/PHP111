<?php
$name_class = "validate";
$reg_name = "";
$lastname_class = "validate";
$reg_lastname = "";
$email_class = "validate";
$reg_email = "";
$telephone_class = "validate";
$reg_telephone = "";
$avatar_class = "validate";
$reg_avatar = "";
$uploadDir = "E:/PHP/www/img/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // оброблення даних форми
    // echo '<pre>' ; print_r( $_POST ) ; exit ;
    // етап 1 - валідація
    if (!isset($_POST['reg-name'])) { // наявність самих даних
        $name_message = "No reg-name field";
    } else {
        $reg_name = $_POST['reg-name'];
        if (strlen($reg_name) < 3) {
            $name_message = "Name too short";
        }
    }



    if (!isset($_POST['reg-lastname'])) { // наявність самих даних
        $lastname_message = "No reg-lastname field";
    } else {
        $reg_lastname = $_POST['reg-lastname'];
        if (strlen($reg_lastname) < 3) {
            $lastname_message = "lastname too short";
        }
    }



    if (!isset($_POST['reg-email'])) { // наявність самих даних
        $email_message = "No reg-email field";
    } else {
        $reg_email = $_POST['reg-email'];
        if (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
            $email_message = "Invalid email format";
        }
    }


    if (!isset($_POST['reg-phone'])) { // Проверяем наличие самих данных
        $telephone_message = "No reg-phone field";
    } else {
        $reg_telephone = $_POST['reg-phone'];
        // Используем регулярное выражение для валидации номера телефона
        if (!preg_match('/^(?:\+\d{10}|\d{7})$/', $reg_telephone)) {
            $telephone_message = "Invalid phone number format";
        }
    }

    if (!isset($_FILES['reg-avatar'])) {
        $avatar_message = "No avatar file uploaded";
    } else {
        $file = $_FILES['reg-avatar'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $avatar_message = "Error uploading the avatar file";
        } else {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

            if (!in_array($file['type'], $allowedTypes) || !in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $avatar_message = "Invalid file type. Allowed types: JPG, JPEG, PNG, GIF";
            }

            $maxFileSize = 2 * 1024 * 1024; // 2 МБ
            if ($file['size'] > $maxFileSize) {
                $avatar_message = "File size exceeds the maximum allowed size (2 MB)";
            }

            // Если все проверки прошли успешно
            if (empty($avatar_message)) {
                // Генерация уникального имени файла с сохранением расширения
                $uniqueFileName = uniqid() . '.' . $extension;

                // Полный путь к новому файлу
                $uploadPath = $uploadDir . $uniqueFileName;

                // Проверка наличия файла с таким именем в папке
                while (file_exists($uploadPath)) {
                    $uniqueFileName = uniqid() . '.' . $extension;
                    $uploadPath = "{$uploadDir}/{$uniqueFileName}";
                }

                // Сохранение файла на сервере
                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    // Файл успешно загружен на сервер
                    $reg_avatar = '/img/' . $uniqueFileName; // Записываем путь к файлу в переменную
                } else {
                    $avatar_message = "Error while saving the avatar file";
                }
            }
        }
    }

    session_start();

    $_SESSION['form_data'] = true;
    $_SESSION['reg_name'] = $reg_name;
    $_SESSION['reg_lastname'] = $reg_lastname;
    $_SESSION['reg_email'] = $reg_email;
    $_SESSION['reg_telephone'] = $reg_telephone;
    $_SESSION['reg_avatar'] = $reg_avatar;
    if (isset($name_message)) {
        $_SESSION['$name_message'] = $name_message;
    }
    if (isset($lastname_message)) {
        $_SESSION['$lastname_message'] = $lastname_message;
    }
    if (isset($email_message)) {
        $_SESSION['$email_message'] = $email_message;
    }
    if (isset($telephone_message)) {
        $_SESSION['$telephone_message'] = $telephone_message;
    }
    if (isset($avatar_message)) {
        $_SESSION['$avatar_message'] = $avatar_message;
    } else {
        if (isset($_FILES['reg-avatar'])) {
            if ($_FILES['reg-avatar']['error'] == 0) {
                if ($_FILES['reg-avatar']['size'] > 0) {
                    move_uploaded_file(
                        $_FILES['reg-avatar']['tmp_name'],
                        "E:/PHP/www/img/{$_FILES['reg-avatar']['name']}"
                    );
                }
            }
        }
    }
    // echo '<pre>' ; print_r($_FILES); exit;

    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
} else {
    session_start();
    if (isset($_SESSION['form_data'])) {
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

        if (isset($name_message)) { // валідація імені не пройшла
            $name_class = "invalid";
        } else { // успішна валідація
            $name_class = "valid";
        }
        if (isset($lastname_message)) { // валідація імені не пройшла
            $lastname_class = "invalid";
        } else { // успішна валідація
            $lastname_class = "valid";
        }
        if (isset($email_message)) { // валідація імені не пройшла
            $email_class = "invalid";
        } else { // успішна валідація
            $email_class = "valid";
        }
        if (isset($telephone_message)) { // валідація імені не пройшла
            $telephone_class = "invalid";
        } else { // успішна валідація
            $telephone_class = "valid";
        }
        if (isset($avatar_class)) { // валідація імені не пройшла
            $avatar_class = "invalid";
        } else { // успішна валідація
            $avatar_class = "valid";
        }

    }
    $page = "forms.php";
    include "_layout.php";
}