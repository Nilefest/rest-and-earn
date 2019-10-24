<?php echo $header_rest ?>

<div class="block-win">
    <div class="row">
        <h2 class="title"><?php echo $rest['name']; ?></h2>
    </div>
    <div class="row">
        <div class="col-10 col-md-6">
            <a href="/rest/edit" class="link">Изменить данные о заведении</a>
        </div>
        <div class="col-10 col-md-6">
            <a href="/reservs/creat/0/<?php echo $rest['id']; ?>" class="button1">Добавить резерв</a>
        </div>
    </div>
    <div class="row">
        <div class="table">
            <div class="row">
                <div class="td"><span>№</span></div>
                <div class="td"><span>Дата</span></div>
                <div class="td"><span>Имя</span></div>
                <div class="td"><span>Сумма по чекам</span></div>
                <div class="td"><span>% комиссии</span></div>
                <div class="td"><span>Сумма комиссии</span></div>
                <div class="td"><span>Статус</span></div>
                <div class="td"><span>Отменить</span></div>
                <div class="td"><span>Редактировать</span></div>
                <div class="td"><span>Удалить</span></div>
                <div class="td"><span>Подтвердить</span></div>
            </div>
            <div class="table_content">
                <?php $n = 1; foreach($reservs as $reserv): ?>
                <div class="row">
                    <div class="td">
                        <?php echo $n++; ?>
                    </div>
                    <div class="td">
                        <?php echo $reserv['date_fin']." - ".$reserv['time']; ?>
                    </div>
                    <div class="td">
                        <?php echo $reserv['visiter']; ?>
                    </div>
                    <div class="td">
                        <?php echo $reserv['cost']; ?>
                    </div>
                    <div class="td">
                        <?php echo $reserv['per_coop']; ?>
                    </div>
                    <div class="td">
                        <?php echo $reserv['cost'] / 100 * $reserv['per_coop']; ?>
                    </div>
                    <div class="td <?php echo $reserv['status']['class']; ?>">
                        <?php echo $reserv['status']['note']; ?>
                    </div>
                    <div class="td"><img id="canc" src="/application/public/img/icon/canc.png" alt="<?php echo $reserv['id']; ?>" class="icon canc"></div>
                    <div class="td"><a target="_blank" href="<?php echo ($reserv['status_end']=='090'?'':"/reservs/edit/".$reserv['id']);?>"><img id="edit" src="/application/public/img/icon/edit.png" alt="<?php echo $reserv['id']; ?>" class="icon edit"></a></div>
                    <div class="td"><img id="rem" src="/application/public/img/icon/rem.png" alt="<?php echo $reserv['id']; ?>" class="icon rem"></div>
                    <div class="td" style="background-color:#<?php echo $reserv['status_end'];?>;"><img id="ok" src="/application/public/img/icon/ok.png" alt="<?php echo $reserv['id']; ?>" class="icon ok"></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/rest/getExcelRestReservs" class="button1">СКАЧАТЬ В EXCEL</a>
        </div>
    </div>
</div>
<script>
    $('.canc').click(function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/rest/reservs",
            data: {
                canc: 1,
                id: id
            },
            success: function(data) {
                location.reload();
            }
        });
    });

    $('.rem').click(function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/rest/reservs",
            data: {
                rem: 1,
                id: id
            },
            success: function(data) {
                location.reload();
            }
        });
    });
    
    $('.ok').click(function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/rest/reservs",
            data: {
                ok: 1,
                id: id
            },
            success: function(data) {
                location.reload();
            }
        });
    });

</script>

<?php echo $footer_login ?>
