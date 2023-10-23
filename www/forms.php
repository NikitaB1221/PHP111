<?php if (isset($db_message)): ?>
    <span class="helper-text">
        <?= $db_message ?>
    </span>
<?php endif ?>
<div class="row">
    <form class="col s12" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="reg-name" name="reg-name" type="text" class=<?= $view_data['reg-name']['class']?>  value=<?= $view_data['reg-name']['value']?>>
                <label for="reg-name">First Name</label>
                <?php if ($view_data['reg-name']['error']): ?>
                    <span class="helper-text" data-error="<?= $view_data['reg-name']['error'] ?>"></span>
                <?php endif ?>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">badge</i>
                <input id="reg-lastname" name="reg-lastname" type="text" class=<?= $view_data['reg-lastname']['class']?>  value=<?= $view_data['reg-lastname']['value']?>>
                <label for="reg-lastname">Login</label>
                <?php if ($view_data['reg-lastname']['error']): ?>
                    <span class="helper-text" data-error="<?= $view_data['reg-lastname']['error'] ?>"></span>
                <?php endif ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">pin</i>
                <input id="reg-phone" name="reg-phone" type="password" class=<?= $view_data['reg-phone']['class']?>  value=<?= $view_data['reg-phone']['value']?>>
                <label for="reg-phone">Password</label>
                <?php if ($view_data['reg-phone']['error']): ?>
                    <span class="helper-text" data-error="<?= $view_data['reg-phone']['error'] ?>"></span>
                <?php endif ?>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">mark_email_unread</i>
                <input id="reg-email" name="reg-email" type="email" class=<?= $view_data['reg-email']['class']?>  value=<?= $view_data['reg-email']['value']?>>
                <label for="reg-email">Email</label>
                <?php if ($view_data['reg-email']['error']): ?>
                    <span class="helper-text" data-error="<?= $view_data['reg-email']['error'] ?>"></span>
                <?php endif ?>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field ">
                <div class="btn purple">
                    <span>File</span>
                    <input type="file" name="reg-avatar">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Select avatar">
                </div>
            </div>
            <?php if (!empty($reg_avatar)): ?>
                <p>Uploaded Avatar: <img src="<?= $reg_avatar ?>" alt="Avatar"></p>
            <?php endif; ?>
            <?php if (isset($avatar_message)): ?>
                <p class="red-text">
                    <?= $avatar_message ?>
                </p>
            <?php endif; ?>
        </div>
        <div class="row center-align">
            <button class="waves-effect waves-light btn purple">
                <i class="material-icons right">how_to_reg</i>Register
            </button>
        </div>
    </form>
</div>
<p>
    Особливості роботи з формами полягають у тому, що оновлення
    сторінки можи привести до повторної передачі даних. У разі
    POST запиту про це видається попередження, у разі GET - повтор
    автоматичний. Рекомендовано роботу з формами розділяти на
    два етапи: 1) прийом і оброблення даних та 2) відображення.
    Між цими етапами сервер передає браузеру редирект і зберігає
    дані у сесії. При повторному запиті дані відновлюються і
    відображаються.
</p>