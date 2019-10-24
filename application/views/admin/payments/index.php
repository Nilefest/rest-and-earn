<?php echo $header_admin ?>

<div class="block-win">
    <div class="row">
        <h2 class="title">Заявки на выплаты (<span class="count">
                <?php echo count($payments); ?></span>)</h2>
    </div>
    <div class="table">
        <div class="row">
            <div class="td"><span>№</span></div>
            <div class="td"><span>Статус</span></div>
            <div class="td"><span>Дата запроса</span></div>
            <div class="td"><span>Сумма</span></div>
            <div class="td"><span>Метод вывода</span></div>
            <div class="td"><span>Номер карты</span></div>
            <div class="td"><span>Имя клиента</span></div>
            <div class="td"><span>E-mail клиента</span></div>
            <div class="td"><span>Пароль клиента</span></div>
            <div class="td"><span>Телефон клиента</span></div>
            <div class="td"><span>Досупно к выводу в аккаунте</span></div>
            <div class="td"><span>Выплачено</span></div>
            <div class="td"><span>Удалить</span></div>
            <div class="td"><span>Редактировать</span></div>
        </div>
        <div class="table_content">
            <?php $n = 1; foreach($payments as $payment): ?>
            <div value="<?php echo $payment['id']; ?>" class="row">
                <div class="td">
                    <?php echo $n++; ?>
                </div>
                <div class="td <?php echo $payment['status']['class']; ?>">
                    <?php echo $payment['status']['note']; ?>
                </div>
                <div class="td">
                    <?php echo $payment['date_st']; ?>
                </div>
                <div class="td">
                    <?php echo $payment['amount']; ?>
                </div>
                <div class="td">
                    <?php echo $payment['method']; ?>
                </div>
                <div class="td">
                    <?php echo $payment['card']; ?>
                </div>
                <div class="td">
                    <?php echo $clients[$payment['cl_id']]['last_name']." ".$clients[$payment['cl_id']]['name']; ?>
                </div>
                <div class="td">
                    <?php echo $clients[$payment['cl_id']]['mail']; ?>
                </div>
                <div class="td">
                    <?php echo $clients[$payment['cl_id']]['password']; ?>
                </div>
                <div class="td">
                    <?php echo $clients[$payment['cl_id']]['phone']; ?>
                </div>
                <div class="td">
                    <?php echo $clients[$payment['cl_id']]['cash']; ?>
                </div>
                <div class="td"><img id="ok" src="/application/public/img/icon/ok.png" alt="<?php echo $payment['id']; ?>" class="icon"></div>
                <div class="td"><img id="rem" src="/application/public/img/icon/rem.png" alt="<?php echo $payment['id']; ?>" class="icon"></div>
                <div class="td"><a href="/admin/payments/<?php echo $payment['id']; ?>"><img id="edit" src="/application/public/img/icon/edit.png" alt="<?php echo $payment['id']; ?>" class="icon"></a></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/admin/getExcelAdmPays" class="button1">СКАЧАТЬ В EXCEL</a>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#rem", function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/admin/payments",
            data: {
                hide_adm: 1,
                id: id
            },
            success: function() {
                location.reload();
            }
        });
        //alert("Резерв удалён. Изменения отобразятся после обновления страницы");
    });
    
    $(document).on("click", "#ok", function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/admin/payments",
            data: {
                ok: 1,
                id: id
            },
            success: function() {
                location.reload();
            }
        });
        //alert("Резерв удалён. Изменения отобразятся после обновления страницы");
    });
</script>
<?php echo $footer_login ?>
