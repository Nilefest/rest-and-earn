<?php echo $header;?>
<div class="row">
    <h2 class="title">РЕДАКТИРОВАТЬ РЕЗЕРВ</h2>
</div>
<div class="block-win" style="width: 70%;">
    <form action="" method="post">
        <div class="row">
            <div class="col-12">
                <label for="date">Дата</label>
                <input type="date" name="date_fin" id="date" placeholder="Дата" value="<?php echo $reserv['date_fin']?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="time">Время</label>
                <input type="time" name="time" id="time" placeholder="Время" value="<?php echo $reserv['time']?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-5">
                <label for="rest_name">Название</label>
            </div>
            <div class="col-12 col-sm-7">
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="rest_id" id="rest_name">
                        <?php foreach($rest as $row): ?>
                        <option value="<?php echo $row['id']; ?>" <?php echo ($reserv['rest_id']==$row['id']?'selected':'');?> >
                            <?php echo $row['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="human_count">Количество человек</label>
                <input type="text" name="hum_count" id="human_count" placeholder="Количество человек" value="<?php echo $reserv['hum_count']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="who_visit">На чьё имя резерв</label>
                <input type="text" name="visiter" id="who_visit" placeholder="Имя Фамилия" value="<?php echo $reserv['visiter']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="phone">Контактный номер телефона</label>
                <input type="text" name="phone" id="phone" placeholder="Номер телефона" value="<?php echo $reserv['phone']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="cost">Сумма по чеку</label>
                <input type="text" name="cost" id="cost" placeholder="%" value="<?php echo $reserv['cost']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="per_coop">Процент комиссии</label>
                <input type="text" name="per_coop" id="per_coop" placeholder="%" value="<?php echo $reserv['per_coop']; ?>">
            </div>
        </div>
        <?php if($adm == 1):?>
        <div class="row">
            <div class="col-12">
                <label for="per_cl">Процент выплаты клиенту</label>
                <input type="text" name="per_cl" id="per_cl" placeholder="%" value="<?php echo $reserv['per_cl']; ?>">
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <input type="hidden" name="cl_id" value="<?php echo $reserv['cl_id']; ?>">
            <input class="button1" type="submit" name="save" id="new_reserv" value="СОХРАНИТЬ">
        </div>

    </form>
</div>
<?php echo $footer_login;?>
