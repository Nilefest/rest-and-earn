<?php echo $header_admin; ?>

<div class="block-win">
    <div class="row">
        <h2 class="title">Кабинеты заведений</h2>
    </div>
    <div class="table">
        <div class="row">
            <div class="td"><span>№</span></div>
            <div class="td"><span>Дата регистрации</span></div>
            <div class="td"><span>Название</span></div>
            <div class="td"><span>Тип</span></div>
            <div class="td"><span>Город</span></div>
            <div class="td"><span>E-mail</span></div>
            <div class="td"><span>Пароль</span></div>
            <div class="td"><span>% сотрудничества</span></div>
            <div class="td"><span>% клиентам</span></div>
            <div class="td"><span>Имя менеджера</span></div>
            <div class="td"><span>Телефон менеджера</span></div>
            <div class="td"><span>Количество посещений</span></div>
            <div class="td"><span>Общая сумма по чекам</span></div>
            <div class="td"><span>Удалить</span></div>
        </div>
        <div class="table_content">
            <?php $n = 1; foreach($rest as $row): ?>
            <div class="row">
                <div class="td">
                    <?php echo $n++; ?>
                </div>
                <div class="td">
                    <?php echo $row['date_reg']; ?>
                </div>
                <div class="td">
                    <?php echo $row['name']; ?>
                </div>
                <div class="td">
                    <?php echo $row['type']; ?>
                </div>
                <div class="td">
                    <?php echo $row['city']; ?>
                </div>
                <div class="td">
                    <?php echo $row['mail']; ?>
                </div>
                <div class="td">
                    <?php echo $row['password']; ?>
                </div>
                <div class="td">
                    <?php echo $row['per_coop']; ?>
                </div>
                <div class="td">
                    <?php echo $row['per_cl']; ?>
                </div>
                <div class="td">
                    <?php echo $row['manager']; ?>
                </div>
                <div class="td">
                    <?php echo $row['phone']; ?>
                </div>
                <div class="td">
                    <?php echo $row['visits']; ?>
                </div>
                <div class="td">
                    <?php echo $row['total_amount']; ?>
                </div>
                <div class="td"><img id="rem" src="/application/public/img/icon/rem.png" alt="<?php echo $row['id']; ?>" class="icon"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-7 col-sm-6">
            <a href="/rest/reg" class="button1">ДОБАВИТЬ ЗАВЕДЕНИЕ</a>
        </div>
        <div class="col-7 col-sm-6">
            <a href="/admin/getExcelAdmRest" class="button1">СКАЧАТЬ В EXCEL</a>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#rem", function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/admin/rest",
            data: {
                rem: 1,
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
