<?php echo $header_rest ?>

<div class="row">
    <h2 class="title">Мой кабинет</h2>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="block-win">
            <div class="block-win balance2">
                <div class="row">
                    <h2 class="title2">БАЛАНС: <br><span class="sum">
                            <?php echo $client['balance']; ?> грн</span></h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="/client/cash" class="button1">Вывод денег</a>
                    </div>
                </div>
            </div>
            <form action="" method="post">
                <div class="row">
                    <div class="col-0 col-md-4">
                        <label for="last_name">Фамилия</label>
                    </div>
                    <div class="col-11 col-md-7">
                        <input type="text" name="last_name" id="last_name" placeholder="Фамилия" value="<?php echo $client['last_name']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-md-4">
                        <label for="name">Имя</label>
                    </div>
                    <div class="col-11 col-md-7">
                        <input type="text" name="name" id="name" placeholder="Имя" value="<?php echo $client['name']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-md-4">
                        <label for="city">Город</label>
                    </div>
                    <div class="col-11 col-md-7">
                        <div class="select-wrapper">
                            <div class="select-arrow-3"></div>
                            <select name="city" id="city">
                                <?php foreach($cities as $city): ?>
                                <option value="<?php echo $city['name']; ?>" <?php echo ($client['city'] == $city['name']? 'selected' : ''); ?>>
                                    <?php echo $city['name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-md-4">
                        <label for="login">E-mail</label>
                    </div>
                    <div class="col-11 col-md-7">
                        <input type="text" name="mail" id="login" placeholder="E-mail" value="<?php echo $client['mail']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-md-4">
                        <label for="password">Пароль</label>
                    </div>
                    <div class="col-11 col-md-7">
                        <input type="password" name="password" id="password" placeholder="Пароль" value="<?php echo $client['password']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-md-4">
                        <label for="phone">Номер телефона</label>
                    </div>
                    <div class="col-11 col-md-7">
                        <input type="text" name="phone" id="phone" placeholder="Номер телефона" value="<?php echo $client['phone']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-md-4">
                        <label for="card">Номер карты Приватбанка</label>
                    </div>
                    <div class="col-11 col-md-7">
                        <input type="text" name="card" id="card" placeholder="Номер карты" value="<?php echo $client['card']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="text-align: center;">
                        <i>Возможно, понадобится зайти в свою учётную запись заново</i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="text-align: center;">
                        <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
                        <input name="save" type="submit" class="button2" value="Сохранить изменения">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="block-win balance">
            <div class="row">
                <h2 class="title2">БАЛАНС: <span class="sum">
                        <?php echo $client['balance']; ?> грн</span></h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="/client/cash" class="button1">Вывод денег</a>
                </div>
            </div>
        </div>
        <div class="block-win nav">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <a href="/reservs/creat" class="button1">СДЕЛАТЬ НОВЫЙ РЕЗЕРВ</a>
                </div>
                <div class="col-12 col-lg-4">
                    <span class="info">ИЛИ МОЖЕШЬ СДЕЛАТЬ РЕЗЕРВ, ПОЗВОНИВ НАМ ПО ТЕЛЕФОНУ</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="/client/rest" class="button2">СПИСОК ЗАВЕДЕНИЙ И УСЛОВИЙ</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="/client/reservs" class="button2">ИСТОРИЯ ЗАКАЗОВ/ОТМЕНА ЗАКАЗА</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <h2 class="title">СОБИРАЕШЬСЯ ПОСЕТИТЬ ЗАВЕДЕНИЕ, НО ЕГО НЕТ В СПИСКЕ?<br>СООБЩИ НАМ - МЫ ДОГОВОРИМСЯ О ТВОЕЙ СКИДКЕ!</h2>
</div>

<?php echo $footer_login ?>
