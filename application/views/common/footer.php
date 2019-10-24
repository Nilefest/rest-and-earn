</div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <img class="logo" src="/application/public/img/logo.png" alt="Logo">
                </div>
                <div class="row copyright">
                    © 2018 Cервис сотрудничества заведений с клиентами
                </div>
            </div>
            <div class="col-4 button">
                <a href="#log-reg" class="button2">ВОЙТИ</a>
                <a href="#log-reg" class="button2">ЗАРЕГИСТРИРОВАТЬСЯ</a>
            </div>
        </div>
    </div>
</footer>
<!-- Optional JS -->
<?php if(isset($js)): foreach($js as $script):?>
<script src="/application/public/js/<?php echo $script;?>.js" type="text/javascript" charset="utf-8"></script>
<?php endforeach; endif; ?>

<script>
    $("#reg_rest_win").slideUp(0);
    $("#reg_cl_win").slideUp(0);
    $("#nopass_win").slideUp(0);

    $("#open_log_rest").click(function() {
        $("#reg_rest_win").slideUp();
        $("#log_rest_win").slideDown();
    });

    $("#open_reg_rest").click(function() {
        $("#log_rest_win").slideUp();
        $("#reg_rest_win").slideDown();
    });

    $("#open_log_cl").click(function() {
        $("#reg_cl_win").slideUp();
        $("#log_cl_win").slideDown();
    });

    $("#open_reg_cl").click(function() {
        $("#log_cl_win").slideUp();
        $("#reg_cl_win").slideDown();
    });


    $("span.nopass").click(function() {
        $("#log_rest_win").slideUp();
        $("#log_cl_win").slideUp();
        $("#reg_rest_win").slideUp();
        $("#reg_cl_win").slideUp();
        $("#nopass_win").slideDown();
    });
    $("#open_log_nopass").click(function() {
        $("#reg_rest_win").slideUp();
        $("#reg_cl_win").slideUp();
        $("#nopass_win").slideUp();
        $("#log_rest_win").slideDown();
        $("#log_cl_win").slideDown();
    });

</script>
</body>

</html>
