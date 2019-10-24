<?php echo $header_client; ?>

<div class="row">
    <h2 class="title">История заказов / отмена</h2>
</div>
<div class="block-win">
    <div class="row">
        <div class="table">
            <div class="row">
                <div class="td"><span>№</span></div>
                <div class="td"><span>Дата</span></div>
                <div class="td"><span>Заведение</span></div>
                <div class="td"><span>Сумма</span></div>
                <div class="td"><span>% кеш-бека</span></div>
                <div class="td"><span>Сумма кеш-бека</span></div>
                <div class="td"><span>Статус</span></div>
                <!--<div class="td"><span>Доступно к выводу</span></div><!---->
                <div class="td"><span>Отменить</span></div>
                <!--<div class="td"><span>Ошибка</span></div><!---->
                <div class="td"><span>Удалить</span></div>
            </div>
            <div class="table_content">
                <?php $n = 1; foreach($reservs as $reserv): if(isset($rest[$reserv['rest_id']]['name'])): ?>
                <div value="<?php echo $reserv['id']; ?>" class="row">
                    <div class="td">
                        <?php echo $n++; ?>
                    </div>
                    <div class="td">
                        <?php echo $reserv['date_fin']; ?>
                    </div>
                    <div class="td">
                        <?php echo $rest[$reserv['rest_id']]['name']; ?>
                    </div>
                    <div class="td">
                        <?php echo $reserv['cost']; ?>
                    </div>
                    <div class="td">
                        <?php echo $reserv['per_cl']; ?>
                    </div>
                    <div class="td">
                        <?php echo ($reserv['cost'] / 100 * $reserv['per_cl']); ?>
                    </div>
                    <div class="td <?php echo $reserv['status']['class']; ?>">
                        <?php echo $reserv['status']['note']; ?>
                    </div>
                    <!--<div class="td">
                        <?php echo $can_cash; ?>
                    </div><!---->
                    <div class="td"><img id="calc" src="/application/public/img/icon/canc.png" alt="<?php echo $reserv['id']; ?>" class="icon"></div>
                    <!--<div class="td"><img id="err" src="/application/public/img/icon/err.png" alt="" class="icon"></div><!-- -->
                    <div class="td"><img id="rem" src="/application/public/img/icon/rem.png" alt="<?php echo $reserv['id']; ?>" class="icon"></div>
                </div>
                <?php endif; endforeach;?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/client/reserv/cl" class="button1">ДОБАВИТЬ НОВЫЙ РЕЗЕРВ</a>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#calc", function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/client/reservs",
            data: {
                canc: 1,
                id: id
            },
            success: function() {
                location.reload();
            }
        });
        //alert("Резерв отменён. Изменения отобразятся после обновления страницы");
    });

    $(document).on("click", "#rem", function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/client/reservs",
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
