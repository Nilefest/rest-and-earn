<?php
class Mail {
	private $registry = array();
	private $smtp = false;
	
	public function __construct($registry) {
        $this->registry = $registry;
        
        $this->registry->load->library('mail');
        $this->smtp = new mailLibrary($this->registry->config->mail_host, 
                                      $this->registry->config->mail_port, 
                                      $this->registry->config->mail_from, 
                                      $this->registry->config->mail_password,
                                      $this->registry->config->mail_sender,
                                      $this->registry->config->url);
	}
    
    public function sendNewPayment($payment){
        $this->sendAdmin('Поступила заявка на выплату кэша. Заявка № '.$payment['id'].' на сумму '.$payment['amount'].'.<br>Подробнее о пользователе на сайте.');
    }
    public function sendCancReserv($reserv){
        $this->sendAdmin('Был отменён резерв №'.$reserv['id'].' на имя '.$reserv['visiter'].'.<br>Подробнее о пользователе на сайте.');
    }
    public function sendNewReserv($rest, $reserv){
        // for Admin
        $text = "Было сделано новый резерв на ".$rest['type']." \"".$rest['name']."\" (".$rest['addr'].") <br>";
        $text .= "От имени ".$reserv['visiter'].", Телефн:".$reserv['phone']."<br>Подробнее читайте на сайте";
        $this->sendAdmin($text);
        //for Rest
        $text = "В ваше заведение был сделан резерв через сервис EastAndEarn сделан резерв <br>";
        $text .= "От имени ".$reserv['visiter'].", Телефн:".$reserv['phone']."<br>Подробнее читайте на сайте";
        $this->sendUser($text, $rest['name'], $rest['mail']);
    }
    public function sendNewRest($name, $mail){
        $text = "В сервисе EastAndEarn был зареестрировано новое заведение.<br>";
        $text .= "Название ".$name.", электронная почта:".$mail."<br>Подробнее читайте на сайте";
        $this->sendAdmin($text);
    }
    public function sendNewClient($name, $mail){
        $text = "В сервисе EastAndEarn был зареестрирован новый клиент.<br>";
        $text .= "Имя ".$name.", электронная почта:".$mail."<br>Подробнее читайте на сайте";
        $this->sendAdmin($text);
    }
    public function sendPass($mail){
        $this->registry->load->model('rest');
        $this->registry->load->model('clients');
        $rest = $this->registry->restModel->getItems(array(), array('mail' => $mail))[0];
        $client = $this->registry->clientsModel->getItems(array(), array('mail' => $mail))[0];
        $text = "";
        if(!$rest || !$client)
            $text = "Вашей учётной записи не найдено в базе данных пользователей сервиса RestAndEarn ".$this->registry->config->url."<br>";
        else{
            $text = "Ваши данные для входа в сервис сервиса RestAndEarn на сайте".$this->registry->config->url."<br><br>";
            if($rest)
                $text .= "Как заведение - login(".$rest['mail']."), password(".$rest['password'].")<br>";
            if($client)
                $text .= "Как клиента - login(".$client['mail']."), password(".$client['password'].")<br>";
        }
        $text .= "По любым вопросам обращайтесь в админитрацию сервиса<hr>Если вы получили это письмо по ошибке -  просто его удалите";
        
        $this->sendAdmin('Пользователь "'.$mail.'" Восстановил свой пароль к учётной записи в сервисе RestAndEarn.<br>Подробнее о пользователе на сайте.');
        
        return $this->smtp->send_smtp('Восстановление пароля', $this->inHTML($text), 'Пользователь RandE', $mail);
    }
    
    public function sendAdmin($text){
        $this->registry->load->model('admin');
        $admins = $this->registry->adminModel->getItems();
        
        foreach($admins as $adm)
            $this->smtp->send_smtp('Уведомление администратору RestAndEarn', $this->inHTML($text), $adm['name'], $adm['mail']);
    }    
    public function sendUser($text, $name, $mail){
        return $this->smtp->send_smtp('Уведомление от RestAndEarn', $this->inHTML($text), $name, $mail);
    }    
    
    private function inHTML($content){
        return '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>R&amp;E Support</title></head><body>'.$content.'</body></html>';
    }
}
?>
