<?php echo $header ?>

<div class="block-win" style="width: 70%;">
    <form action="/client/personal" method="post">
        <div class="row">
            <h2 class="title">РЕГИСТРАЦИЯ КЛИЕНТА</h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="login">Электронная почта (логин)</label>
                <input type="text" name="mail" id="login" placeholder="E-mail" value="<?php echo $mail; ?>">
            </div>
            <div class="col-12 col-md-6">
                <label for="pass">Пароль</label>
                <input type="password" name="password" id="pass" placeholder="Пароль" value="<?php echo $password; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" placeholder="Имя">
            </div>
            <div class="col-12 col-md-6">
                <label for="last_name">Фамилия</label>
                <input type="text" name="last_name" id="last_name" placeholder="Фамилия">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="city">Город</label>
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="city" id="city">
                        <?php foreach($cities as $city): ?>
                        <option value="<?php echo $city['name']; ?>">
                            <?php echo $city['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" id="phone" placeholder="+380*********">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="card">Номер карты Приватбанка(необязательно)</label>
                <input type="text" name="card" id="card" placeholder="Номер карты">
            </div>
        </div>
        <div class="row">
            <input class="button1" type="submit" name="reg" id="reg_cl" value="СОХРАНИТЬ ИЗМЕНЕНИЯ">
        </div>
    </form>
</div>

<?php echo $footer ?>
