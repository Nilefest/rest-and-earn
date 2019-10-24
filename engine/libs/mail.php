<?php

class mailLibrary {
    
    // Hosting vars
    private $hosting;
    private $port;
    private $login;
    private $pass;
    
    // Libs vars
    private $h2t;
    private $mail_lib;
    
    function __construct($hosting_mail, $port_mail, $mail_from, $pass_login, $name_from, $unsub_link) { 
        
        //$this->Test('support@rest-and-earn.top', '7Hry784ojVDO', 'nikitaleo777333@gmail.com');
        
        // Файлы phpmailer
        require_once  ENGINE_DIR."/libs/phpmailer/class.phpmailer.php";
        require_once  ENGINE_DIR."/libs/phpmailer/class.smtp.php";
        require_once  ENGINE_DIR."/libs/phpmailer/extras/class.html2text.php";

		$this->hosting = $hosting_mail;
		$this->port = $port_mail;
		$this->login = $mail_from;
		$this->pass = $pass_login;
        
        $this->mail_lib = new PHPMailer;
        // Настройки
        $this->mail_lib->isSMTP(); 
        $this->mail_lib->Host = $this->hosting;
        $this->mail_lib->SMTPAuth = true; 
        $this->mail_lib->Username = $this->login;// Ваш логин 
        $this->mail_lib->Password = $this->pass;    // Ваш пароль
        $this->mail_lib->SMTPSecure = "tls";        //tls tss
        $this->mail_lib->Port = $this->port;
        
        $this->mail_lib->setFrom($this->login, $this->toCode($name_from)); // Проверка сервера, логина и пароля
        $this->mail_lib->setUnsubscribeLink($unsub_link."?mail=".$to_mail);
        
        // Письмо
        $this->mail_lib->isHTML(true);
	}
    
    public function send_smtp($title, $text, $to_name, $to_mail, $file = false){
        require_once  ENGINE_DIR."/libs/phpmailer/extras/class.html2text.php";
        
        $this->h2t = new Html2Text($text);
        $this->mail_lib->AltBody = $this->h2t->get_text();

        // Email получателя
        $this->mail_lib->addAddress($to_mail, $this->toCode($to_name));

        // Заголовок и текст письма
        $this->mail_lib->Subject = $this->toCode($title);
        $this->mail_lib->Body = $text;

        // Прикреплённые файлы
        if($file) $this->mail_lib->addAttachment($file['path'], $file['name']);

        // Отправка и результат
        if(!$this->mail_lib->send()) return "Message could not be sent"."Mailer Error: ". $this->mail_lib->ErrorInfo;
        else return "Message send. OK";
    }
    
    private function toCode($text){
        return "=?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode($text)))."?= ";
    }
    
    public function Test($login, $password, $to){
        //$login = 'test@domain.tld'; // замените test@domain.tld на адрес электронной почты, с которого производится отправка. Поскольку логин совпадает с адресом отправителя - данная переменная используется и как логин, и как адрес отправителя. 

        //$password = 'password';  // Замените 'password' на пароль от почтового ящика, с которого производится отправка.
        //$to = 'to@domain.tld';  // замените to@domain.tld на адрес электронной почты получателя письма.
        $text="Привет, проверка связи по SMTP.";  // Содержимое отправляемого письма
        function get_data($smtp_conn)  // функция получения кода ответа сервера. 
        {
        $data="";
        while($str = fgets($smtp_conn,515)) 
        {
        $data .= $str;
        if(substr($str,3,1) == " ") { break; }
        }
        return $data;
        }
        // формируем служебный заголовок письма.
        $header="Date: ".date("D, j M Y G:i:s")." +0700\r\n"; 
        $header.="From: =?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode('Тестовый скрипт')))."?= <$login>\r\n"; 
        $header.="X-Mailer: Test script hosting Ukraine.com.ua \r\n"; 
        $header.="Reply-To: =?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode('Тестовый скрипт')))."?= <$login>\r\n";
        $header.="X-Priority: 3 (Normal)\r\n";
        $header.="Message-ID: <12345654321.".date("YmjHis")."@ukraine.com.ua>\r\n";
        $header.="To: =?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode('Получателю тестового письма')))."?= <$to\r\n";
        $header.="Subject: =?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode('проверка')))."?=\r\n";
        $header.="MIME-Version: 1.0\r\n";
        $header.="Content-Type: text/plain; charset=UTF-8\r\n";
        $header.="Content-Transfer-Encoding: 8bit\r\n";
        $smtp_conn = fsockopen("mail.ukraine.com.ua", 25,$errno, $errstr, 10); //соединяемся с почтовым сервером mail.ukraine.com.ua , порт 25 .
        if(!$smtp_conn) {print "соединение с серверов не прошло"; fclose($smtp_conn); exit;}  
        $data = get_data($smtp_conn);
        fputs($smtp_conn,"EHLO mail.ukraine.com.ua\r\n"); // начинаем приветствие.
        $code = substr(get_data($smtp_conn),0,3); // проверяем, не возвратил ли сервер ошибку.
        if($code != 250) {print "ошибка приветсвия EHLO"; fclose($smtp_conn); exit;}
        fputs($smtp_conn,"AUTH LOGIN\r\n"); // начинаем процедуру авторизации.
        $code = substr(get_data($smtp_conn),0,3);
        if($code != 334) {print "сервер не разрешил начать авторизацию"; fclose($smtp_conn); exit;}

        fputs($smtp_conn,base64_encode("$login")."\r\n"); // отправляем серверу логин от почтового ящика (на хостинге "Украина" он совпадает с именем почтового ящика).
        $code = substr(get_data($smtp_conn),0,3);
        if($code != 334) {print "ошибка доступа к такому юзеру"; fclose($smtp_conn); exit;}

        fputs($smtp_conn,base64_encode("$password")."\r\n");       // отправляем серверу пароль.
        $code = substr(get_data($smtp_conn),0,3);                 
        if($code != 235) {print "неправильный пароль"; fclose($smtp_conn); exit;}

        fputs($smtp_conn,"MAIL FROM:$login\r\n"); // отправляем серверу значение MAIL FROM.
        $code = substr(get_data($smtp_conn),0,3);
        if($code != 250) {print "сервер отказал в команде MAIL FROM"; fclose($smtp_conn); exit;}

        fputs($smtp_conn,"RCPT TO:$to\r\n"); // отправляем серверу адрес получателя.
        $code = substr(get_data($smtp_conn),0,3);
        if($code != 250 AND $code != 251) {print "Сервер не принял команду RCPT TO"; fclose($smtp_conn); exit;}

        fputs($smtp_conn,"DATA\r\n"); // отправляем команду DATA.
        $code = substr(get_data($smtp_conn),0,3);
        if($code != 354) {print "сервер не принял DATA"; fclose($smtp_conn); exit;}

        fputs($smtp_conn,$header."\r\n".$text."\r\n.\r\n"); // отправляем тело письма.
        $code = substr(get_data($smtp_conn),0,3);
        if($code != 250) {print "ошибка отправки письма"; fclose($smtp_conn); exit;}

        if($code == 250) {print "Письмо отправлено успешно. Ответ сервера $code"  ;}

        fputs($smtp_conn,"QUIT\r\n");   // завершаем отправку командой QUIT.
        fclose($smtp_conn); // закрываем соединение.
    }
}

?>