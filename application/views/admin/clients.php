<?php echo $header_admin ?>

<div class="block-win">
    <div class="row">
        <h2 class="title">Клиенты</h2>
    </div>
    <div class="table">
        <div class="row">
            <div class="td"><span>№</span></div>
            <div class="td"><span>Дата регистрации</span></div>
            <div class="td"><span>Имя</span></div>
            <div class="td"><span>Город</span></div>
            <div class="td"><span>Логин</span></div>
            <div class="td"><span>Пароль</span></div>
            <div class="td"><span>Баланс</span></div>
            <div class="td"><span>Доступно к выводу</span></div>
            <div class="td"><span>Телефон</span></div>
            <div class="td"><span>Количество посещений</span></div>
            <div class="td"><span>Удалить</span></div>
            <div class="td"><span>Редактировать</span></div>
        </div>
        <div class="table_content">
            <?php $n = 1; foreach($clients as $client): ?>
            <div value="<?php echo $client['id']; ?>" class="row">
                <div class="td">
                    <?php echo $n++; ?>
                </div>
                <div class="td">
                    <?php echo $client['date_reg']; ?>
                </div>
                <div class="td">
                    <?php echo $client['last_name']." ".$client['name']; ?>
                </div>
                <div class="td">
                    <?php echo $client['city']; ?>
                </div>
                <div class="td">
                    <?php echo $client['mail']; ?>
                </div>
                <div class="td">
                    <?php echo $client['password']; ?>
                </div>
                <div class="td">
                    <?php echo $client['balance']; ?>
                </div>
                <div class="td">
                    <?php echo $client['cash']; ?>
                </div>
                <div class="td">
                    <?php echo $client['phone']; ?>
                </div>
                <div class="td">
                    <?php echo $client['visits']; ?>
                </div>
                <div class="td"><img id="rem" src="/application/public/img/icon/rem.png" alt="<?php echo $client['id']; ?>" class="icon"></div>
                <div class="td"><a href="/admin/cledit/<?php echo $client['id']; ?>"><img id="edit" src="/application/public/img/icon/edit.png" alt="<?php echo $client['id']; ?>" class="icon"></a></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/admin/getExcelAdmCl" class="button1">СКАЧАТЬ В EXCEL</a>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#rem", function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/admin/clients",
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
