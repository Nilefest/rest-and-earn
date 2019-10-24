<?php echo $header_admin ?>

<div class="block-win" style="width: 80%">
    <div class="row">
        <a href="/admin/clients" class="button2">Вернуться</a>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="title">ИЗМЕНЕНИЕ ДАННЫХ О КЛИЕНТЕ</h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" value="<?php echo $client['name']; ?>" placeholder="Имя">
            </div>
            <div class="col-12 col-md-6">
                <label for="last_name">Фамилия</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo $client['last_name']; ?>" placeholder="Фамилия">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="login">E-mail</label>
                <input type="text" name="mail" id="login" value="<?php echo $client['mail']; ?>" placeholder="E-mail">
            </div>
            <div class="col-12 col-md-6">
                <label for="pass">Пароль</label>
                <input type="text" name="password" id="pass" value="<?php echo $client['password']; ?>" placeholder="Пароль">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="city">Город</label>
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="city" id="city">
                        <?php foreach($cities as $city): ?>
                        <option value="<?php echo $city['name']; ?>" <?php echo ($client['city']==$city['name'] ?'selected':''); ?>>
                            <?php echo $city['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label for="visits">Количество визитов</label>
                <input type="text" name="visits" id="visits" placeholder="Количество визитов" value="<?php echo $client['visits']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="card">Карты Приват</label>
                <input type="text" name="card" id="card" value="<?php echo $client['card']; ?>" placeholder="Карты Приват">
            </div>
            <div class="col-12 col-md-6">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" id="phone" value="<?php echo $client['phone']; ?>" placeholder="Телефон">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="balance">Баланс</label>
                <input type="text" name="balance" id="balance" value="<?php echo $client['balance']; ?>" placeholder="Баланс">
            </div>
            <div class="col-12 col-md-6">
                <label for="cash">Можно вывести</label>
                <input type="text" name="cash" id="cash" value="<?php echo $client['cash']; ?>" placeholder="Можно вывести">
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
            <input class="button1" type="submit" name="save" id="reg_rest" value="СОХРАНИТЬ ИЗМЕНЕНИЯ">
        </div>
    </form>
</div>

<?php echo $footer_login ?>
