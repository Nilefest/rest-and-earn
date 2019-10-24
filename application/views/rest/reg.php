<?php echo $header; ?>

<div class="block-win" style="width: 80%">
    <form action="/rest" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="title">РЕГИСТРАЦИЯ ЗАВЕДЕНИЙ</h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="login">E-mail</label>
                <input type="text" name="mail" id="login" value="<?php echo $mail; ?>" placeholder="E-mail">
            </div>
            <div class="col-12 col-md-6">
                <label for="pass">Пароль</label>
                <input type="password" name="password" id="pass" value="<?php echo $password; ?>" placeholder="Пароль">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="type">Тип завдения</label>
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="type" id="type">
                        <?php foreach($rest_type as $type): ?>
                        <option value="<?php echo $type['name']; ?>">
                            <?php echo $type['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <label for="name">Название</label>
                <input type="text" name="name" id="name" placeholder="Название заведения">
            </div>
            <div class="col-6 col-md-3">
                <label for="per_com">Комиссия</label>
                <input type="text" name="per_coop" id="per_com" placeholder="%">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="menager">Имя менеджера</label>
                <input type="text" name="manager" id="menager" placeholder="Менеджер">
            </div>
            <div class="col-12 col-md-6">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" id="phone" placeholder="+380*********">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="city">Город</label>
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="city" id="city">
                        <?php foreach($cities as $city): ?>
                        <option <?php echo ($city['name'] == 'Киев'? 'selected' : ''); ?> value="<?php echo $city['name']; ?>" <?php echo ($city['name']=="Киев" ?'selected':''); ?>>
                            <?php echo $city['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label for="addr">Адрес</label>
                <input type="text" name="addr" id="addr" placeholder="Адрес">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-7">
                <label for="desc">Описание заведения (не обязательно)</label>
                <textarea name="description" id="desc" placeholder="Описание"></textarea>
            </div>
            <div class="col-12 col-md-5">
                <label for="url">Cайта (не обязательно)</label>
                <input type="text" name="url" id="url" placeholder="URL">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="logo">Логотип (не обязательно)</label>
                <input type="file" name="file_logo" id="logo" value="Загрузить новый">
            </div>
        </div>
        <div class="row">
            <input class="button1" type="submit" name="reg" id="reg_rest" value="СОХРАНИТЬ ИЗМЕНЕНИЯ">
        </div>
    </form>
</div>

<?php echo $footer ?>
