<?php echo $header;?>
<div class="row">
    <h2 class="title">НОВЫЙ РЕЗЕРВ</h2>
</div>
<div class="block-win" style="width: 70%;">
    <form action="" method="post">
        <div class="row">
            <div class="col-12">
                <label for="date">Дата</label>
                <input type="date" name="date_fin" id="date" placeholder="Дата">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="time">Время</label>
                <input type="time" name="time" id="time" placeholder="Время">
            </div>
        </div>
        <!--<div class="row">
            <div class="col-12 col-sm-5">
                <label for="rest_type">Тип заведения</label>
            </div>
            <div class="col-12 col-sm-7">
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="type" id="rest_type">
                        <?php foreach($rest_type as $type): ?>
                        <option value="<?php echo $type['id']; ?>">
                            <?php echo $type['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div><!---->
        <div class="row">
            <div class="col-12 col-sm-5">
                <label for="rest_name">Название</label>
            </div>
            <div class="col-12 col-sm-7">
                <div class="select-wrapper">
                    <div class="select-arrow-3"></div>
                    <select name="rest_id" id="rest_name">
                        <?php foreach($rest as $row): ?>
                        <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $_GET['rest']?'selected':''); ?>>
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
                <input type="text" name="hum_count" id="human_count" placeholder="Количество человек">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="who_visit">На чьё имя резерв</label>
                <input type="text" name="visiter" id="who_visit" placeholder="Имя Фамилия" value="<?php echo $client['last_name']." ".$client['name']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="phone">Контактный номер телефона</label>
                <input type="text" name="phone" id="phone" placeholder="Номер телефона" value="<?php echo $client['phone']; ?>">
            </div>
        </div>
        <div class="row">
            <input class="button1" type="submit" name="new" id="new_reserv" value="СДЕЛАТЬ РЕЗЕРВ">
        </div>

    </form>
</div>
<script>
    $("select#rest_type").change(function() {
        $.ajax({
            method: "POST",
            url: "/rest/byType",
            data: {type: $("select#rest_type").val()},
            success: function(data) {
                alert(data);
                var rests = JSON.parse(data);
                    $("#rest_name").html('');
                for (var n in rests) {
                    $("#rest_name").append('<option value="' + rests[n]['id'] + '">' + rests[n]['name'] + '</option>');
                }
            }
        })
    });

</script>
<?php echo $footer_login;?>