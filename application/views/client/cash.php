<?php echo $header_client ?>

<div class="row">
    <h2 class="title">Вывод денег</h2>
</div>
<div class="block-win">
    <form action="" method="post">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <label for="total">Общий баланс</label>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <input type="text" name="total" id="total" disabled value="<?php echo $client['balance'];?>">
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <label for="available">Доступно к выводу</label>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <input type="text" name="available" id="available" disabled value="<?php echo $client['cash']?>">
            </div>
        </div>
        <div class="row">
            <div class="block-win">
                Вывести деньги можно начиная от минимальной суммы 200 гривен через две недели после даты начисления бонусов
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="amount">Какую сумму вы хотите вывести (мин. 200 грн)</label>
            </div>
            <div class="col-12 col-sm-6">
                <input type="text" name="amount" id="amount">
            </div>
        </div>
        <div class="row">
            <h2 class="col-12 title">
                Выберите способ оплаты
            </h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <input id="b_cash" type="button" class="button1" value="Забрать в офисе наличными">
            </div>
            <div class="col-12 col-md-6">
                <input id="b_card" type="button" class="button1" value="На карту Приватбанка">
            </div>
        </div>
        <div class="row to_cash">
            <div class="row">
                <div class="col-12">
                    <label for="phone">Введите ваш номенр телефона, мы Вам перезвоним</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <input type="text" name="phone" id="phone" placeholder="Номер телефона" value="<?php echo $client['phone']; ?>">
                </div>
                <div class="col-6">
                    <input type="submit" class="button1" name="in_cash" value="Отправить">
                </div>
            </div>
        </div>
        <div class="row to_card">
            <div class="row">
                <div class="col-2 col-sm-1">
                    <input type="radio" name="type_card" value="my" id="use_my" checked=true>
                </div>
                <div class="col-10 col-sm-5">
                    <label for="use_my">Выбрать номер карты, указанный в Вашем кабинете</label>
                </div>
                <div class="col-2 col-sm-1">
                    <input type="radio" name="type_card" value="new" id="use_new">
                </div>
                <div class="col-10 col-sm-5">
                    <label for="use_new">Указать номер другой карты</label>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <input type="text" name="card" id="card_num" placeholder="Номер карты" value="1234 XXXX XXXX 4321" disabled>
                </div>
                <div class="col-12 col-md-6">
                    <input type="submit" class="button1" name="in_card" value="Отправить">
                </div>
            </div>
        </div>
    </form>
</div>

<?php echo $footer_login ?>
