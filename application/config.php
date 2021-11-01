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
    'url' => 'http://site.top/',
    
    // Тип подключения к MySQL (mysql, mysqli, pdo ...).
    'db_type' => 'pdo',
    
    // Хост БД.
    'db_hostname' => 'host',
    
    // Порт БД.
    'db_port' => 3306,
    
    // Имя пользователя СУБД.
    'db_username' => 'root',
    
    // Пароль пользователя СУБД.
    'db_password' => 'root',
    
    // Название БД.          
    'db_database' => 'dbname',
    
    // E-Mail отправителя.
    'mail_host' => 'host',
    
    // E-Mail отправителя.
    'mail_port' => '25',
    
    // E-Mail отправителя.
    'mail_from' => 'mail@mail.top',
    
    // Пароль E-Mail`a отправителя.
    'mail_password' => 'pass',
    
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
