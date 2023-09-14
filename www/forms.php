<?php
$name_class = "validate";
$reg_name = "";
$lastname_class = "validate";
$reg_lastname = "";
$email_class = "validate";
$reg_email = "";
$telephone_class = "validate";
$reg_telephone = "";

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
    if (isset($name_message)) { // валідація імені не пройшла
        $name_class = "invalid";
    } else { // успішна валідація
        $name_class = "valid";
    }



    if (!isset($_POST['reg-lastname'])) { // наявність самих даних
        $lastname_message = "No reg-lastname field";
    } else {
        $reg_lastname = $_POST['reg-lastname'];
        if (strlen($reg_lastname) < 3) {
            $lastname_message = "lastname too short";
        }
    }
    if (isset($lastname_message)) { // валідація імені не пройшла
        $lastname_class = "invalid";
    } else { // успішна валідація
        $lastname_class = "valid";
    }



    if (!isset($_POST['reg-email'])) { // наявність самих даних
        $email_message = "No reg-email field";
    } else {
        $reg_email = $_POST['reg-email'];
        if (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
            $email_message = "Invalid email format";
        }
    }
    if (isset($email_message)) { // валідація імені не пройшла
        $email_class = "invalid";
    } else { // успішна валідація
        $email_class = "valid";
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
    if (isset($telephone_message)) { // валідація імені не пройшла
        $telephone_class = "invalid";
    } else { // успішна валідація
        $telephone_class = "valid";
    }



}

?>
<div class="row">
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="reg-name" name="reg-name" type="text" class='<?= $name_class ?>' value='<?= $reg_name ?>'>
                <label for="reg-name">First Name</label>
                <?php if (isset($name_message)): ?>
                    <span class="helper-text" data-error="<?= $name_message ?>"></span>
                <?php endif ?>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">badge</i>
                <input id="reg-lastname" name="reg-lastname" type="text" class='<?= $lastname_class ?>'
                    value='<?= $reg_lastname ?>'>
                <label for="reg-lastname">Last Name</label>
                <?php if (isset($lastname_message)): ?>
                    <span class="helper-text" data-error="<?= $lastname_message ?>"></span>
                <?php endif ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="reg-phone" name="reg-phone" type="tel" class='<?= $telephone_class ?>'
                    value='<?= $reg_telephone ?>'>
                <label for="reg-phone">Telephone</label>
                <?php if (isset($telephone_message)): ?>
                    <span class="helper-text" data-error="<?= $telephone_message ?>"></span>
                <?php endif ?>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">mark_email_unread</i>
                <input id="reg-email" name="reg-email" type="email" class='<?= $email_class ?>'
                    value='<?= $reg_email ?>'>
                <label for="reg-email">Email</label>
                <?php if (isset($email_message)): ?>
                    <span class="helper-text" data-error="<?= $email_message ?>"></span>
                <?php endif ?>
            </div>
        </div>
        <div class="row center-align">
            <button class="waves-effect waves-light btn purple">
                <i class="material-icons right">how_to_reg</i>Register
            </button>
        </div>
    </form>
</div>