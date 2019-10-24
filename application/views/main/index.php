<?php echo $header ?>

<p class="header-text row">
    <span class="col-12"><a name="log-reg"></a>ПРИВОДИ КЛИЕНТОВ В ЗАВЕДЕНИЯ И РЕСТОРАНЫ<br>НАЗНАЧАЙ СВИДАНИЯ, ОТДЫХАЙ С ДРУЗЬЯМИ, РЕКОМЕНДУЙ ЗНАКОМЫМ<br><b>ПОЛУЧАЙ % ОТ ПОТРАЧЕННЫХ ИМИ ДЕНЕГ</b></span>
</p>
<div class="row reg-log-win">
    <div class="col-6">
        <div class="block-win" id="reg_cl_win">
            <form action="/client/reg" method="post">
                <div class="row">
                    <strong class="title">РЕГИСТРАЦИЯ ДЛЯ КЛИЕНТОВ</strong>
                </div>
                <div class="row">
                    <input type="text" id="login" name="mail" placeholder="Ваш E-mail">
                </div>
                <div class="row">
                    <input type="password" id="pass" name="password" placeholder="Пароль">
                </div>
                <div class="row">
                    <input class="button1" type="submit" id="reg_client" name="reg_client" value="ЗАРЕГИСТРИРОВАТЬСЯ">
                </div>
                <div class="row">
                    <a class="coop" href="#">УСЛОВИЯ СОТРУДНИЧЕСТВА</a>
                </div>
                <div class="row">
                    <span id="open_log_cl" class="log-in">
                        <b>ВХОД</b><br>
                        <span>Для зарегестрированных пользователей</span>
                    </span>
                </div>
            </form>
        </div>
        <div class="block-win" id="log_cl_win">
            <form action="/client" method="post">
                <div class="row">
                    <strong class="title">ВХОД ДЛЯ КЛИЕНТОВ</strong>
                </div>
                <div class="row">
                    <input type="text" id="login" name="mail" placeholder="Ваш E-mail">
                </div>
                <div class="row">
                    <input type="password" id="pass" name="password" placeholder="Пароль">
                </div>
                <div class="row">
                    <input class="button1" type="submit" id="log_client" name="log-in" value="ВОЙТИ">
                </div>
                <div class="row">
                    <span class="nopass">Забыли пароль?</span>
                </div>
                <div class="row">
                    <span class="reg-in" id="open_reg_cl">
                        <b>ЗАРЕГИСТРИРОВАТЬСЯ</b><br>
                        <span>Если вы ещё этого не сделали</span>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="col-6">
        <div class="block-win" id="reg_rest_win">
            <form action="/rest/reg" method="post">
                <div class="row">
                    <strong class="title">РЕГИСТРАЦИЯ ДЛЯ ЗАВЕДЕНИЙ</strong>
                </div>
                <div class="row">
                    <input type="text" id="login" name="mail" placeholder="Ваш E-mail">
                </div>
                <div class="row">
                    <input type="password" id="pass" name="password" placeholder="Пароль">
                </div>
                <div class="row">
                    <input class="button1" type="submit" id="reg_rest" name="reg_rest" value="ЗАРЕГИСТРИРОВАТЬСЯ">
                </div>
                <div class="row">
                    <a class="coop" href="#">УСЛОВИЯ СОТРУДНИЧЕСТВА</a>
                </div>
                <div class="row">
                    <span class="log-in" id="open_log_rest">
                        <b>ВХОД</b><br>
                        <span>Для зарегестрированных пользователей</span>
                    </span>
                </div>
            </form>
        </div>
        <div class="block-win" id="log_rest_win">
            <form action="/rest" method="post">
                <div class="row">
                    <strong class="title">ВХОД ДЛЯ ЗАВЕДЕНИЙ</strong>
                </div>
                <div class="row">
                    <input type="text" id="login" name="mail" placeholder="Ваш E-mail">
                </div>
                <div class="row">
                    <input type="password" id="pass" name="password" placeholder="Пароль">
                </div>
                <div class="row">
                    <input class="button1" type="submit" id="log_rest" name="log-in" value="ВОЙТИ">
                </div>
                <div class="row">
                    <span class="nopass">Забыли пароль?</span>
                </div>
                <div class="row">
                    <span class="reg-in" id="open_reg_rest">
                        <b>ЗАРЕГИСТРИРОВАТЬСЯ</b><br>
                        <span>Если вы ещё этого не сделали</span>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row reg-log-win">
    <div class="block-win nopass_win" id="nopass_win">
        <form action="/" method="post">
            <div class="row">
                <strong class="title">Восстановление пароля</strong>
            </div>
            <div class="row">
                <span class="about">
                    Забыли пароль? Ничего страшного, укажите e-mail и мы вышлем на него ваш пароль
                </span>
            </div>
            <div class="row">
                <input type="text" name="mail" id="email" placeholder="Введите ваш E-mail">
            </div>
            <div class="row">
                <input class="button1" type="submit" id="new_pass" name="new_pass" value="ВОССТАНОВИТЬ ПАРОЛЬ">
            </div>
            <div class="row">
                <span class="log-in" id="open_log_nopass">
                    <b>ВХОД</b><br>
                    <span>Для зарегестрированных пользователей</span>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="row reg-log-win2">
    <div class="col-12">
        <a href="/client/reg" class="button1" id="button1">Регистрация клиента</a>
    </div>
    <div class="col-12">
        <a href="/rest/reg" class="button1" id="button1">Регистрация заведения</a>
    </div>
</div>
<div class="row">
    <h2 class="title">Отдыхай и зарабатывай с нами</h2>
</div>
<div class="row">
    <div class="col-6 col-md-3">
        <img class="pane1-img" src="/application/public/img/pane1/1.png" alt="Регистрируйся на сайте">
    </div>
    <div class="col-6 col-md-3">
        <img class="pane1-img" src="/application/public/img/pane1/2.png" alt="Назначай время прихода">
    </div>
    <div class="col-6 col-md-3 img_sec">
        <img class="pane1-img" src="/application/public/img/pane1/3.png" alt="Зарабатывай бонусы">
    </div>
    <div class="col-6 col-md-3 img_sec">
        <img class="pane1-img" src="/application/public/img/pane1/4.png" alt="Выводи деньги">
    </div>
</div>
<div class="row">
    <div class="col-6 col-md-3">
        <div class="pane1-block">
            <h3>РЕГИСТРИРУЙСЯ НА САЙТЕ</h3>
            <span>ЭТО СОВЕРШЕННО БЕСПЛАТНО И ЗАЙМЁТ ВСЕГО <b>2-3</b> МИНУТЫ</span>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="pane1-block">
            <h3>НАЗНАЧАЙ ВРЕМЯ ПРИХОДА</h3>
            <span>ДЕЛАЙ РЕЗЕРВ В ЗАВЕДЕНИИ, НАЗНАЧАЙ ВРЕМЯ ПРИХОДА В МАГАЗИНЕ ИЛИ ЗАКАЗА СЕРВИСА, ИСПОЛЬЗУЯ ЭТОТ САЙТ</span>
        </div>
    </div>
    <div class="col-6 col-md-3 img_sec2">
        <img class="pane1-img" src="/application/public/img/pane1/3.png" alt="Зарабатывай бонусы">
    </div>
    <div class="col-6 col-md-3 img_sec2">
        <img class="pane1-img" src="/application/public/img/pane1/4.png" alt="Выводи деньги">
    </div>
    <div class="col-6 col-md-3">
        <div class="pane1-block">
            <h3>ЗАРАБАТЫВАЙ БОНУСЫ</h3>
            <span>ЗАРАБАТЫВАЙ БОНУСЫ ПОСЛЕ ТОГО, КАК ПРИВЕДЁННЫЙ ТОБОЙ КЛИЕНТЫ ОПЛАТЯТ ЗАКАЗ/СЕРВИС ИЛИ СОВЕРШАТ ПОКУПКУ, ТЕБЕ БУДУТ НАЧИСЛЕНЫ БОНУСЫ В РАЗМЕРЕ ОТ <b>7%</b> ДО <b>20%</b> ОТ ЧЕКА</span>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="pane1-block">
            <h3>ВЫВОДИ ДЕНЬГИ</h3>
            <span>ЗАЙДИ В ЛИЧНЫЙ КАБИНЕТ НА НАШЕМ САЙТЕ, ЗАПРОСИ ВЫВОД БОНУСОВ НА КАРТУ ИЛИ ПОЛУЧИ НАЛИЧНЫМИ</span>
        </div>
    </div>
</div>
<div class="row">
    <a class="button1" href="/#log-reg">ЗАРЕГИСТРИРОВАТЬСЯ</a>
</div>
<div class="row">
    <h2 class="title">Условия сотрудничества для клиентов</h2>
</div>
<div class="row coop-cl">
    <div class="col-12 col-md-6">
        <ul>
            <li><img src="/application/public/img/coop-cl/1.png" alt="Регистрируйся"><span>Регистрируйся на сайте и начинай зарабатывать с нами</span></li>
            <div class="clear"></div>
            <li><img src="/application/public/img/coop-cl/2.png" alt="Cмотри список"><span>Cмотри список заведений и сервисов, с которыми мы сотрудничаем</span></li>
            <div class="clear"></div>
            <li><img src="/application/public/img/coop-cl/3.png" alt="Резервируй"><span>Резервируй время прихода в заведения/магазины/сервисы</span></li>
            <div class="clear"></div>
            <li><img src="/application/public/img/coop-cl/4.png" alt="Приводи клиентов"><span>Приводи клиентов в рестораны, кафе, салоны красоты, отели, бюро переводов, магазины, службы такси, массажные салоны и языковые курсы</span></li>
            <div class="clear"></div>
            <li><img src="/application/public/img/coop-cl/5.png" alt="Получи процент"><span>Получи процент от чека <b>(7%-20%)</b></span></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="col-12 col-md-6">
        <div class="block-win">
            <span class="title">Чем больше твой приглашенный потратит денег в заведении, тем больше ты получишь бонусов на свой счёт.</span><br><br>
            <a class="button1" href="/#log-reg">ЗАРЕГИСТРИРОВАТЬСЯ</a>
        </div>
        <div class="recom">
            <span>Рекомендации</span>
            <ol>
                <li>В ресторане желательно оставить чаевые около <b>10%</b></li>
                <li>Убедитесь, что у приведённых тобой клиентов нет скидочной карты заведения</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <h2 class="title"><i>Платят они - зарабатываешь ты!</i></h2>
</div>
<div class="row">
    <span class="title">Если остались вопросы, мы ответим на любой из них Оставьте ваш номер телефона, мы перезвоним</span>
</div>
<div class="row callback">
    <form action="/" method="post">
        <input type="text" id="phone" placeholder="Ваш номер телефона">
        <input class="button1" type="submit" id="callback" value="ПЕРЕЗВОНИТЕ МНЕ">
    </form>
</div>
<div class="row coop-rest">
    <h2 class="title">Условия сотрудничества с заведениями</h2>
    <span class="title">СОТРУДНИЧАЯ С НАМИ, ВЫ ПОЛУЧАЕТЕ БОЛЬШЕ КЛИЕНТОВ, БОЛЬШЕ РЕКЛАМЫ, БОЛЬШЕ ДОХОДОВ</span>
    <h2 class="title">С помощью нашего сервиса вы сможете</h2>
    <ul>
        <li><img src="/application/public/img/coop-rest/1.jpg" alt="Увеличить поток клиентов в своё заведение или магазин, и, соответственно, повысить прибыль"><span><b>Увеличить поток клиентов</b> в своё заведение или магазин, и, соответственно, повысить прибыль</span></li>
        <div class="clear"></div>
        <li><img src="/application/public/img/coop-rest/2.jpg" alt="Получить новый вид рекламы, потому что пользователи нашего сайта будут приводить вам новых клиентов"><span>Получить новый вид рекламы, потому что пользователи нашего сайта будут приводить вам новых клиентов</span></li>
        <div class="clear"></div>
        <li><img src="/application/public/img/coop-rest/3.jpg" alt="Увеличить доход: так как пользователь нашего сайта получает процент от чека, он заинтересован, чтобы приглашенные им друзья тратили больше в вашем заведении "><span><b>Увеличить доход:</b> так как пользователь нашего сайта получает процент от чека, он заинтересован, чтобы приглашенные им друзья тратили больше в вашем заведении </span></li>
        <div class="clear"></div>
    </ul>
</div>
<div class="row">
    <h2 class="title"><i>Свяжитесь с нами, чтобы уточнить процент комиссионных и обсудить условия сотрудничества. </i></h2>
</div>
<div class="row callback">
    <form action="/" method="post">
        <input type="text" id="phone" placeholder="Ваш номер телефона">
        <input class="button1" type="submit" id="callback" value="ПЕРЕЗВОНИТЕ МНЕ">
    </form>
</div>

<?php echo $footer ?>
