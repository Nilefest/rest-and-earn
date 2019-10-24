<?php echo $header_client ?>

<div class="row">
    <h2 class="title">Список заведений и условия сотрудничества</h2>
</div>
<div class="block-win" style="width: 80%;">
    <div class="row">
        <div class="col-6 col-md-2">
            <label for="rest_city">Город</label>
        </div>
        <div class="col-6 col-md-5">
            <div class="select-wrapper">
                <div class="select-arrow-3"></div>
                <select name="rest_city" id="rest_city">
                    <?php foreach($cities as $city): ?>
                    <option <?php echo ($city['name'] == 'Киев'? 'selected' : ''); ?> value="<?php echo $city['name']; ?>">
                        <?php echo $city['name']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <label for="rest_type">Тип заведения</label>
        </div>
        <div class="col-6 col-md-3">
            <div class="select-wrapper">
                <div class="select-arrow-3"></div>
                <select name="rest_type" id="rest_type">
                    <?php foreach($rest_type as $type): ?>
                    <option value="<?php echo $type['name']; ?>">
                        <?php echo $type['name']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <?php $n = 1; foreach($rest as $row): ?>
    <div class="row rest_block" id="rest_block">
        <div class="col-11 col-lg-8 rest">
            <table>
                <tr class="row">
                    <td class="num col-1">
                        <?php echo $n++; ?>.</td>
                    <td class="logo col-2">
                        <img style="width:100%" src="<?php echo $row['logo_url']; ?>" alt="">
                    </td>
                    <td class="info col-4">
                        <div class="name">
                            <?php echo $row['name']; ?>
                        </div>
                        <div class="type">
                            <?php echo $row['type']; ?>
                        </div>
                        <div class="city">
                            <?php echo $row['city']; ?>
                        </div>
                    </td>
                    <td class="desc col-5">
                        <?php echo $row['addr']." <br>".$row['description']."<br>Процент cash-back: ".$row['per_cl']."%"; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-11 col-lg-3">
            <a href="/reservs/creat?rest=<?php echo $row['id']; ?>" class="button2">СДЕЛАТЬ РЕЗЕРВ</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
    $("select#rest_type").change(function() {
        $.ajax({
            method: "POST",
            url: "/rest/byType",
            data: {type: $("select#rest_type").val()},
            success: function(data) {
                //alert(data);                
                $(".rest_block").remove();
                var rests = JSON.parse(data);
                for (var n in rests) {
                    var block = '';
                    block += '<div class="row rest_block" id="rest_block"><div class="col-11 col-lg-8 rest"><table><tr class="row"><td class="num col-1">' + rests[n]['id'] + '.</td><td class="logo col-2"><img style="width:100%"  src="/application/public/img/rests/' + rests[n]['id'] + '.png"></td><td class="info col-4"><div class="name">' + rests[n]['name'] + '</div><div class="type">' + rests[n]['type'] + '</div>'+
                    '<div class="city">' + rests[n]['city'] + '</div></td><td class="desc col-5">' + rests[n]['addr'] + '<br>' + rests[n]['description'] + '<br>Процент cash-back: ' + rests[n]['per_cl'] + '%</td></tr></table></div><div class="col-11 col-lg-3"><a href="/client/reserv/cl/' + rests[n]['id'] + '" class="button2">СДЕЛАТЬ РЕЗЕРВ</a></div></div>';
                    
                    $(".block-win").append(block);
                }
            }
        })
    });

    $("select#rest_city").change(function() {
        $.ajax({
            method: "POST",
            url: "/rest/byCity",
            data: {city: $("select#rest_city").val()},
            success: function(data) {
                //alert(data);
                $(".rest_block").remove();
                var rests = JSON.parse(data);
                for (var n in rests) {
                    var block = '';
                    block += '<div class="row rest_block" id="rest_block"><div class="col-11 col-lg-8 rest"><table><tr class="row"><td class="num col-1">' + rests[n]['id'] + '.</td><td class="logo col-2"><img style="width:100%"  src="/application/public/img/rests/' + rests[n]['id'] + '.png" alt="Логотип"></td><td class="info col-4"><div class="name">' + rests[n]['name'] + '</div><div class="type">' + rests[n]['type'] + '</div>'+
                    '<div class="city">' + rests[n]['city'] + '</div></td><td class="desc col-5">' + rests[n]['addr'] + '<br>' + rests[n]['description'] + '<br>Процент cash-back: ' + rests[n]['per_cl'] + '%</td></tr></table></div><div class="col-11 col-lg-3"><a href="/client/reserv/cl/' + rests[n]['id'] + '" class="button2">СДЕЛАТЬ РЕЗЕРВ</a></div></div>';
                    
                    $(".block-win").append(block);
                }
            }
        })
    });

</script>
<?php echo $footer_login ?>
