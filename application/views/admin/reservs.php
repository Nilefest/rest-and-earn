<?php echo $header_admin ?>

<div class="block-win">
    <div class="row nav">
        <div class="col"><a href="/admin/payments">Заявки на выплаты (<span class="count">
                    <?php echo $pay_count; ?></span>)</a></div>
        <div class="col"><a href="/admin/clients">Клиенты</a></div>
        <div class="col"><a href="/admin/rest">Заведения</a></div>
    </div>
        <form action="" method="post">
    <div class="row filter">
            <div class="col-lg-2 col-md-1 col-2">
                <span class="title">Период</span>
            </div>
            <div class="col-lg-3 col-md-5 col-4">
                <label for="date_st">С</label>
                <input name="date_st" type="date" id="date_st" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-lg-3 col-md-5 col-4">
                <label for="date_fin">По</label>
                <input name="date_fin" type="date" id="date_fin" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-lg-4 col-md-1 col-2">
                <input type="submit" name="date_filter" class="button2" style="float:right; margin-top:-10px;" value="Применить"><!---->
                <a href="/admin/reservs" id="refresh" class="button2">Сброс</a>
            </div>
    </div>
        </form>
    <div class="row sort">
        <div class="col-3 col-lg-2">
            <span class="title">Сортировка по</span>
        </div>
        <div class="col-2 col-lg-1">
            <a style="color:#271a60; border-bottom: 2px solid #271a60;" href="/admin/reservs?sort=date" id="refresh" class="sort">Дате</a>
        </div>
        /
        <div class="col-3 col-lg-4">
            <a style="color:#271a60; border-bottom: 2px solid #271a60;" href="/admin/reservs?sort=big" id="refresh" class="sort">Сумме (от большего)</a>
        </div>
        /
        <div class="col-3 col-lg-4">
            <a style="color:#271a60; border-bottom: 2px solid #271a60;" href="/admin/reservs?sort=small" id="refresh" class="sort">Сумме (от меньшего)</a>
        </div>
    </div>
    <div class="table">
        <div class="row">
            <div class="td"><span>№</span></div>
            <div class="td"><span>Статус</span></div>
            <div class="td"><span>Дата</span></div>
            <div class="td"><span>Заведение</span></div>
            <div class="td"><span>На кого</span></div>
            <div class="td"><span>Телефон</span></div>
            <div class="td"><span>Сумма</span></div>
            <div class="td"><span>Комиссия</span></div>
            <div class="td"><span>Сумма по %</span></div>
            <div class="td"><span>Редактировать</span></div>
            <div class="td"><span>Удалить</span></div>
            <div class="td"><span>Подтвердить</span></div>
        </div>
        <div class="table_content">
            <?php $n = 1; foreach($reservs as $reserv): if(isset($rest[$reserv['rest_id']]['name'])): ?>
            <div class="row">
                <div class="td">
                    <?php echo $n++; ?>
                </div>
                <div class="td <?php echo $reserv['status']['class']; ?>">
                    <?php echo $reserv['status']['note']; ?>
                </div>
                <div class="td">
                    <?php echo $reserv['date_fin']; ?>
                </div>
                <div class="td">
                    <?php echo $rest[$reserv['rest_id']]['name']; ?>
                </div>
                <div class="td">
                    <?php echo $reserv['visiter']; ?>
                </div>
                <div class="td">
                    <?php echo $reserv['phone']; ?>
                </div>
                <div class="td">
                    <?php echo $reserv['cost']; ?>
                </div>
                <div class="td">
                    <?php echo $reserv['per_coop']; ?>
                </div>
                <div class="td">
                    <?php echo ($reserv['cost'] / 100 * $reserv['per_coop']); ?>
                </div>
                <div class="td"><a target="_blank" href="/reservs/edit/<?php echo $reserv['id']; ?>"><img id="edit" src="/application/public/img/icon/edit.png" alt="<?php echo $reserv['id']; ?>" class="icon"></a></div>
                <div class="td"><img id="rem" src="/application/public/img/icon/rem.png" alt="<?php echo $reserv['id']; ?>" class="icon"></div>
                <div style="background-color:#<?php echo $reserv['status_end'];?>" class="td"><img id="ok" src="/application/public/img/icon/ok.png" alt="<?php echo $reserv['id']; ?>" class="icon"></div>
            </div>
            <?php endif; endforeach; ?>
            <div class="row">
                <div class="col-6"></div>
                <div class="col-3">Общая сумма <span>
                        <?php echo $total_cost; ?></span></div>
                <!--<div class="col-3">Общая сумма по % <span>
                        <?php echo $total_cash; ?></span></div><!---->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <a href="/admin/rest2" class="button1">СПИСОК ЗАВЕДЕНИЙ</a>
        </div>
        <div class="col-6">
            <a href="/admin/getExcelAdmReservs" class="button1">СКАЧАТЬ В EXCEL</a>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#calc", function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/admin/reservs",
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
            url: "/admin/reservs",
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

    $(document).on("click", "#ok", function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            url: "/admin/reservs",
            data: {
                ok: 1,
                id: id
            },
            success: function() {
                location.reload();
            }
        });
        //alert("Резерв подтверждён. Изменения отобразятся после обновления страницы");
    });

</script>

<?php echo $footer_login ?>
