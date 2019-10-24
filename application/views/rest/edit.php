<?php echo $header_rest ?>

<div class="block-win" style="width: 80%">
    <div class="row">
        <a href="/rest" class="button2">Вернуться</a>
    </div>
    <form action="/rest/edit" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="title">ИЗМЕНЕНИЕ ДАННЫХ О ЗАВЕДЕНИИ</h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="login">E-mail</label>
                <input type="text" name="mail" id="login" value="<?php echo $rest['mail']; ?>" placeholder="E-mail">
            </div>
            <div class="col-12 col-md-6">
                <label for="pass">Пароль</label>
                <input type="text" name="password" id="pass" value="<?php echo $rest['password']; ?>" placeholder="Пароль">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="type">Тип завдения</label>
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="type" id="type">
                        <?php foreach($rest_type as $type): ?>
                        <option value="<?php echo $type['name']; ?>" <?php echo ($rest['type']==$type['name']?'selected':''); ?>>
                            <?php echo $type['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <label for="name">Название</label>
                <input type="text" name="name" id="name" placeholder="Название заведения" value="<?php echo $rest['name']; ?>">
            </div>
            <div class="col-6 col-md-3">
                <label for="per_com">Комиссия</label>
                <input type="text" name="per_coop" id="per_com" placeholder value="<?php echo $rest['per_coop']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="menager">Имя менеджера</label>
                <input type="text" name="menager" id="menager" placeholder="Менеджер" value="<?php echo $rest['manager']; ?>">
            </div>
            <div class="col-12 col-md-6">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" id="phone" placeholder="+380*********" value="<?php echo $rest['phone']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="city">Город</label>
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="city" id="city">
                        <?php foreach($cities as $city): ?>
                        <option value="<?php echo $city['name']; ?>" <?php echo ($rest['city']==$city['name'] ?'selected':''); ?>>
                            <?php echo $city['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label for="addr">Адрес</label>
                <input type="text" name="addr" id="addr" placeholder="Адрес" value="<?php echo $rest['addr']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-7">
                <label for="desc">Описание заведения (не обязательно)</label>
                <textarea name="description" id="desc" placeholder="Описание"><?php echo $rest['description']; ?></textarea>
            </div>
            <div class="col-12 col-md-5">
                <label for="url">Cайта (не обязательно)</label>
                <input type="text" name="url" id="url" placeholder="URL" value="<?php echo $rest['url']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="logo">Логотип (не обязательно)</label>
                <input type="file" name="file_logo" id="logo" value="Загрузить новый">
            </div>
        </div>
        <?php if($adm == 1):?>
        <div class="row">
            <div class="col-12">
                <label for="per_cl">Процент выплаты клиенту</label>
                <input type="text" name="per_cl" id="per_cl" placeholder="%" value="<?php echo $rest['per_cl']; ?>">
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <input type="hidden" name="id" value="<?php echo $rest['id']; ?>">
            <input class="button1" type="submit" name="save" id="reg_rest" value="СОХРАНИТЬ ИЗМЕНЕНИЯ">
        </div>
    </form>
</div>

<?php echo $footer_login ?>
