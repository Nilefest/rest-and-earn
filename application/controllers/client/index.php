<?php

class indexController extends Controller {
    
	public function index() {
        if(isset($this->request->post['reg'])){
            $this->load->model('clients');
            $this->clientsModel->addItem(array('date_reg' => date('Y-m-d'), 
                                              'name' => $this->request->post['name'], 
                                              'last_name' => $this->request->post['last_name'], 
                                              'city' => $this->request->post['city'], 
                                              'mail' => $this->request->post['mail'], 
                                              'password' => $this->request->post['password'], 
                                              'card' => $this->request->post['card'], 
                                              'phone' => $this->request->post['phone']));
            $this->mail->sendNewClient($this->request->post['last_name']." ".$this->request->post['name'], $this->request->post['mail']);
            $this->user->loginClient($this->request->post['mail'], $this->request->post['password']);
        }
        
        if(isset($this->request->post['log-in'])) 
            $this->user->loginClient($this->request->post['mail'], $this->request->post['password']);
        
        if(!$client = $this->user->isClient()) $this->response->redirect('/');
        $this->response->redirect('/client/profile');
        
	}
    
	public function profile() {
        $this->load->model('clients');
        if(empty($client = $this->user->isClient())) $this->response->redirect('/');
        $client_id = $client['id'];
        $client = $this->clientsModel->getItems(array(), array('id' => $client['id']));
        if(isset($this->request->post['save'])){
            $this->clientsModel->updateItems(array('name' => $this->request->post['name'], 
                                                  'last_name' => $this->request->post['last_name'], 
                                                  'city' => $this->request->post['city'], 
                                                  'mail' => $this->request->post['mail'], 
                                                  'password' => $this->request->post['password'], 
                                                  'card' => $this->request->post['card'], 
                                                  'phone' => $this->request->post['phone']), array('id' => $this->request->post['id']));
            $this->response->redirect('/');
        }
        
        $this->load->model('cash');
        $cashes = $this->cashModel->getItems(array(), array('cl_id' => $client['id']));
        foreach($cashes as $cash){
            $amount = 0;
            $days = date_diff(new DateTime(), new DateTime(substr($cash['date'], 0, 4)."-".substr($cash['date'], 5, 2)."-".substr($cash['date'], 8, 2)." 00:00:01"))->days . "<br>";
            if($days > 13){
                $this->cashModel->deleteItems(array('id' => $cash['id']));
                $cash += $cash['amount'];
            }
            $this->clientsModel->updateItems(array('cash' => $this_cl['cash'] + $amount), array('id' => $this_reserv['cl_id']));
        }
        
        $this->data['client'] = $this->clientsModel->getItems(array(), array('id' => $client_id))[0];
        
        $this->load->model('city');
        $this->data['cities'] = $this->cityModel->getItems();
        
        $this->config->css = array('all', 'adm', 'cl_cab');
        $this->config->description = "Кабинет";        
		$this->getChild(array('common/header_rest', 'common/footer_login'));
		return $this->load->view('client/profile', $this->data);
	}
    
	public function reg() {
                
        if(isset($this->request->post['reg_client'])){
            $this->data['mail'] = $this->request->post['mail'];
            $this->data['password'] = $this->request->post['password'];
        }
        
        $this->load->model('city');
        $this->data['cities'] = $this->cityModel->getItems();
        
        $this->config->css = array('all', 'reg');
        $this->config->description = "Регистрация клиента";
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('client/reg', $this->data);
        
	}
    
	public function rest() {
        if(!$client = $this->user->isClient()) $this->response->redirect('/');
        
        $this->load->model('rest_type');
        $this->data['rest_type'] = $this->rest_typeModel->getItems();
        
        $this->load->model('city');
        $this->data['cities'] = $this->cityModel->getItems();
        
        $this->load->model('rest');
        $this->data['rest'] = $this->restModel->getItems();   
        foreach($this->data['rest'] as $key => $rest){
            if(file_exists(APPLICATION_DIR . 'public/img/rests/' . $rest['id'] . ".png"))
                $logo_url = "/application/public/img/rests/" . $rest['id'] . ".png";
            else
                $logo_url = "/application/public/img/rest_logo.png";
            $this->data['rest'][$key]['logo_url'] = $logo_url;
        }      
        
        $this->config->css = array('all', 'adm_all_rest');
        $this->config->description = "Список заведений";
		$this->getChild(array('common/header_client', 'common/footer_login'));
		return $this->load->view('client/rest', $this->data);
	}
    
	public function reservs() {
        if(!$client = $this->user->isClient()) $this->response->redirect('/');
        
        $this->load->model('reservs');
        
        if(isset($this->request->post['canc'])){
            $this->reservsModel->updateItems(array('is_undo' => 1), array('id' => $this->request->post['id']));
            $this->mail->sendCancReserv($this->reservsModel->getItems(array(), array('id' => $this->request->post['id']))[0], $this->request->post['amount']);
        }
        if(isset($this->request->post['rem']))
            $this->reservsModel->updateItems(array('hide_cl' => 1), array('id' => $this->request->post['id']));
        
        $reservs = $this->reservsModel->getItems(array(), array('cl_id' => $client['id'], 'hide_cl' => 0)); 
        
        foreach($reservs as $key => $reserv){
            if($reserv['is_undo'] == '1')                       // ОТМЕНЕНО, если отменено
                $reservs[$key]['status'] = $this->config->status_reserv[3];
            elseif($reserv['date_fin'] > date('Y-m-d'))         // В ПРОЦЕССЕ, если дата не наступила
                $reservs[$key]['status'] = $this->config->status_reserv[2];
            elseif($reserv['ok_adm'] == '1')                    // ЗАВЕРШЕНО, если администратор нажал завершить
                $reservs[$key]['status'] = $this->config->status_reserv[0];
            elseif($reserv['cost'] == 0 || $reserv['per_coop'] == 0 || $reserv['per_cl'] == 0)   // НЕ ХВАТАЕТ ДАННЫХ, если дата наступила, а не указано сумма по чеку или  процент комиссии или процент клиенту
                $reservs[$key]['status'] = $this->config->status_reserv[1];
            elseif($reserv['date_fin'] < date('Y-m-d'))         // ЗАВЕРШЕНО, если дата прошла и указана сумма по чеку и процент комиссии
                $reservs[$key]['status'] = $this->config->status_reserv[0];
        }
        
        $this->data['reservs'] = $reservs;
        $this->data['can_cash'] = $client['cash'];
        
        $this->load->model('rest');
        $this->data['rest'] = $this->restModel->colInKey($this->restModel->getItems());
        $this->data['client'] = $client;
        
        $this->config->css = array('all', 'adm', 'cl_his');
        $this->config->description = "История заказов";
		$this->getChild(array('common/header_client', 'common/footer_login'));
		return $this->load->view('client/reservs', $this->data);
	}
    
	public function cash() {
        if(!$client = $this->user->isClient()) $this->response->redirect('/');
        
        $this->load->model('payments');
        if(isset($this->request->post['in_cash'])){
            $this->paymentsModel->addItem(array('date_st' => date('Y-m-d'),
                                               'amount' => $this->request->post['amount'],
                                               'cl_id' => $client['id'],
                                               'card' => $this->request->post['card'],
                                               'phone' => $this->request->post['phone'],
                                               'method' => "Наличными")); 
            $this->mail->sendNewPayment($this->paymentsModel->getMax(), $this->request->post['amount']);
        }
        if(isset($this->request->post['in_card'])){
            if($this->request->post['type_card'] == 'my') $card = $client['card'];
            else $card = $this->request->post['card'];
            
            $this->paymentsModel->addItem(array('date_st' => date('Y-m-d'),
                                               'amount' => $this->request->post['amount'],
                                               'cl_id' => $client['id'],
                                               'phone' => $this->request->post['phone'],
                                               'card' => $card,
                                               'method' => "На карту")); 
        }
        
        $this->data['client'] = $client;
        
        $this->config->css = array('all', 'cl_money');
        $this->config->description = "Вывод денег";
		$this->getChild(array('common/header_client', 'common/footer_login'));
		return $this->load->view('client/cash', $this->data);
	}
}
?>
