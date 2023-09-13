<?php
$name_class = "validate";
$reg_name = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // оброблення даних форми
    // echo '<pre>' ; print_r( $_POST ) ; exit ;
    // етап 1 - валідація
    if (!isset($_POST['reg-name'])) { // наявність самих даних
        $name_message = "No reg-name field";
    } else {
        $reg_name = $_POST['reg-name'];
        if (strlen($reg_name) < 2) {
            $name_message = "Name too short";
        }
    }
    if (isset($name_message)) { // валідація імені не пройшла
        $name_class = "invalid";
    } else { // успішна валідація
        $name_class = "valid";
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
                <input id="reg-lastname" name="reg-lastname" type="text" class="validate">
                <label for="reg-lastname">Last Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="reg-telephone" name="reg-telephone" type="tel" class="validate">
                <label for="reg-telephone">Telephone</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">mark_email_unread</i>
                <input id="reg-email" name="reg-email" type="email" class="validate">
                <label for="reg-email">Email</label>
            </div>
        </div>
        <div class="row center-align">
            <button class="waves-effect waves-light btn purple">
                <i class="material-icons right">how_to_reg</i>Register
            </button>
        </div>
    </form>
</div>