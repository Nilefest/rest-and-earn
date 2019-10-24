<?php echo $header ?>

<div class="block-win" style="width: 70%;">
    <form action="/admin" method="post">
        <div class="row">
            <h2 class="title">Введите логин и пароль</h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="login">Логин</label>
                <input type="text" name="login" id="login" placeholder="логин">
            </div>
            <div class="col-12 col-md-6">
                <label for="pass">Пароль</label>
                <input type="password" name="pass" id="pass" placeholder="Пароль">
            </div>
        </div>
        <div class="row">
            <input class="button1" type="submit" name="log-in" id="reg_cl" value="Войти">
        </div>
    </form>
</div>

<?php echo $footer ?>
