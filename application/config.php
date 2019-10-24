<?php

// Admin mail
// rest.and.earn.ua@gmail.com
// Test mail
// nikitaleo777333@gmail.com

$config = array(
    
    // Название компании.
    'title' => 'R&E',
    
    // Описание компании (meta description).
    'description' => 'Официальный сайт',
    
    // Ключевые слова (meta keywords).
    'keywords' => 'cashback, restoran',
        
    // Текущий URL-страницы.
    'url' => 'http://www.rest-and-earn.top/',
    
    // Тип подключения к MySQL (mysql, mysqli, pdo ...).
    'db_type' => 'pdo',
    
    // Хост БД.
    'db_hostname' => 'restan02.mysql.tools',
    
    // Порт БД.
    'db_port' => 3306,
    
    // Имя пользователя СУБД.
    'db_username' => 'restan02_db',
    
    // Пароль пользователя СУБД.
    'db_password' => 'ACTrbACw',
    
    // Название БД.          
    'db_database' => 'restan02_db',
    
    // E-Mail отправителя.
    'mail_host' => 'mail.adm.tools',
    
    // E-Mail отправителя.
    'mail_port' => '25',
    
    // E-Mail отправителя.
    'mail_from' => 'support@rest-and-earn.top',
    
    // Пароль E-Mail`a отправителя.
    'mail_password' => '7Hry784ojVDO',
    
    // Имя отправителя.
    'mail_sender' => 'R&E Support',
    
    // Optional css script
    'css' => array(),
    
    // Optional js script
    'js' => array(),
    
    // for status by reservs
    'status_reserv' => array(array('class'=>'res_ok', 'note'=>'Завершено'),
                             array('class'=>'res_data', 'note'=>'Не хватает данных'),
                             array('class'=>'res_proc', 'note'=>'В процессе'),
                             array('class'=>'res_canc', 'note'=>'Отменено')),
    
    // for status by payments
    'status_pay' => array(array('class'=>'pay_y', 'note'=>'Выплачено'),
                          array('class'=>'pay_n', 'note'=>'В заявке')),
    
    // for status by payments
    'status_end' => array('ok_rest'=>'990', 'ok_adm'=>'090')
);
    
?>
