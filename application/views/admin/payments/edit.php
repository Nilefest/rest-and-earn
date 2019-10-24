<?php echo $header_admin ?>

<div class="block-win" style="width: 80%">
    <div class="row">
        <a href="/admin/payments" class="button2">Вернуться</a>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="title">ИЗМЕНЕНИЕ ДАННЫХ В ЗАЯВКЕ НА ВЫПЛАТЫ</h2>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="client">Клиент</label>
                <input type="text" name="client" id="client" value="<?php echo $clients[$payment['cl_id']]['last_name']." ".$clients[$payment['cl_id']]['name']; ?>" placeholder="Клиент" disabled>
            </div>
            <div class="col-12 col-md-6">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" id="phone" value="<?php echo $payment['phone']; ?>" placeholder="Телефон">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="method">Метод</label>
                <input type="text" name="method" id="method" value="<?php echo $payment['method']; ?>" placeholder="Метод">
            </div>
            <div class="col-12 col-md-6">
                <label for="amount">Сумма в заявке</label>
                <input type="text" name="amount" id="amount" value="<?php echo $payment['amount']; ?>" placeholder="Сумма">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="is_fin">Оплачено ли</label>
                <input type="checkbox" name="is_fin" id="is_fin" <?php echo $payment['is_fin']; ?> >
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
            <input class="button1" type="submit" name="save" id="reg_rest" value="СОХРАНИТЬ ИЗМЕНЕНИЯ">
        </div>
    </form>
</div>

<?php echo $footer_login ?>
