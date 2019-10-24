</div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="row">
                    <img class="logo" src="/application/public/img/logo.png" alt="Logo">
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <span>
                    <img class="icon" src="/application/public/img/icon/mail.png" alt="mail_ico">
                    REST.AND.EARN.UA@GMAIL.COM
                </span>
                <span>
                    <img class="icon" src="/application/public/img/icon/phone.png" alt="phone_ico">
                    +380935749453
                </span>
            </div>
            <div class="col-2 button hidden-md-down">
                <a href="#up" class="button2">Наверх</a>
            </div>
        </div>

        <div class="row copyright">
            © 2018 Cервис сотрудничества заведений с клиентами
        </div>
    </div>
</footer>

<!-- Optional JS -->
<?php if(isset($js)): foreach($js as $script):?>
<script src="/application/public/js/<?php echo $script;?>.js" type="text/javascript" charset="utf-8"></script>
<?php endforeach; endif; ?>

<script>
    $(".to_cash").slideUp(0);
    $(".to_card").slideUp(0);

    $("#b_cash").click(function() {
        $(".to_card").slideUp();
        $(".to_cash").slideDown();
        $("#b_card").removeClass("b1_hover");
        $("#b_cash").addClass("b1_hover");
    });

    $("#b_card").click(function() {
        $(".to_cash").slideUp();
        $(".to_card").slideDown();
        $("#b_cash").removeClass("b1_hover");
        $("#b_card").addClass("b1_hover");
    });

    $("#use_new").click(function() {
        $("#card_num").prop('disabled', false);
    });

    $("#use_my").click(function() {
        $("#card_num").prop('disabled', true);
    });

</script>
</body>

</html>
