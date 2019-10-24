<?php

class indexController extends Controller {
    
	public function index() {
        if(isset($this->request->post['log-in'])) $this->user->loginAdmin($this->request->post['login'], $this->request->post['pass']);
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/admin/login');
        $this->response->redirect('/admin/reservs');
	}
    
	public function login() {
        $this->config->css = array('all', 'reg');
        $this->config->title = "ADM";
        $this->config->description = "Войти";
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('admin/login', $this->data);
	}
    
	public function reservs() {
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $total_cost = 0;
        $total_cash = 0;
        
        $this->load->model('reservs');
        $this_reserv = $this->reservsModel->getItems(array(), array('id' => $this->request->post['id']))[0];
        if(isset($this->request->post['canc']))
            $this->reservsModel->updateItems(array('is_undo' => 1), array('id' => $this->request->post['id']));
        if(isset($this->request->post['rem']))
            $this->reservsModel->updateItems(array('hide_adm' => 1), array('id' => $this->request->post['id']));
        if(isset($this->request->post['ok']))
        {
            if($this_reserv['ok_adm'] != 1){
                $this_reserv = $this->reservsModel->getItems(array(), array('id' => $this->request->post['id']))[0];
                $cl_cash = ($this_reserv['cost'] / 100 * $this_reserv['per_cl']);

                $this->load->model('clients');
                $this_cl = $this->clientsModel->getItems(array(), array('id' => $this_reserv['cl_id']))[0];
                $this->clientsModel->updateItems(array('balance' => $this_cl['balance'] + $cl_cash), array('id' => $this_reserv['cl_id']));

                $this->load->model('cash');
                $this_cl = $this->cashModel->addItem(array('cl_id' => $this_reserv['cl_id'], 'date' => $this_reserv['date_fin'], 'amount' => $cl_cash));

                $this->reservsModel->updateItems(array('ok_adm' => 1), array('id' => $this->request->post['id']));
            }
        }
        
        $sort = array();
        $special = "";
        if(isset($this->request->post['date_filter']))
            $special = "`date_fin` >= '".$this->request->post['date_st']."' AND `date_fin` <= '".$this->request->post['date_fin']."'";            
        if(isset($this->request->get['sort'])){
            if($this->request->get['sort'] == 'date')
                $sort = array('date_fin' => 'ASC');
            if($this->request->get['sort'] == 'big')
                $sort = array('cost' => 'ASC');
            if($this->request->get['sort'] == 'small')
                $sort = array('cost' => 'DESC');
        }
        
        $reservs = $this->reservsModel->getItems(array(), array('hide_adm' => 0), array(), $sort, array(), $special);
        foreach($reservs as $key => $reserv){
            $total_cost += $reserv['cost'];
            $total_cash += $reserv['cost'] / 100 * $reserv['cash'];
            
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
            
            if($reserv['ok_adm'] == '1') $reservs[$key]['status_end'] = $this->config->status_end['ok_adm'];
            elseif($reserv['ok_rest'] == '1') $reservs[$key]['status_end'] = $this->config->status_end['ok_rest'];
        }
        $this->data['reservs'] = $reservs;
        $this->data['total_cost'] = $total_cost;
        $this->data['total_cash'] = $total_cash;
        
        $this->load->model('rest');
        $this->data['rest'] = $this->restModel->colInKey($this->restModel->getItems());
                
        $this->load->model('payments');
        
        $this->data['pay_count'] = count($this->paymentsModel->getItems(array('id'), array('date_fin' => '')));
        $this->config->css = array('all', 'adm', 'adm_cab');
        $this->config->title = "ADM";
        $this->config->description = "Резервы";
		$this->getChild(array('common/header_admin', 'common/footer_login'));
		return $this->load->view('admin/reservs', $this->data);
	}
    
	public function clients() {
        
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $this->load->model('clients');
        
        if(isset($this->request->post['rem']))
            $this->clientsModel->deleteItems(array('id' => $this->request->post['id']));
        
        $clients = $this->clientsModel->getItems();
        foreach($clients as $client){
            $this->load->model('cash');
            
            $cashes = $this->cashModel->getItems(array(), array('cl_id' => $client['id']));
            foreach($cashes as $cash){
                $amount = 0;
                $days = date_diff(new DateTime(), new DateTime(substr($cash['date'], 0, 4)."-".substr($cash['date'], 5, 2)."-".substr($cash['date'], 8, 2)." 00:00:01"))->days . "<br>";
                if($days > 13){
                    $this->cashModel->deleteItems(array('id' => $cash['id']));
                    $amount += $cash['amount'] + 0;
                }
                $this->clientsModel->updateItems(array('cash' => 0 + $amount + $client['cash']), array('id' => $cash['cl_id']));
            }
        }
        $this->data['clients'] = $this->clientsModel->getItems();
        
        $this->config->css = array('all', 'adm', 'adm_cl');
        $this->config->title = "ADM";
        $this->config->description = "Клиенты";
		$this->getChild(array('common/header_admin', 'common/footer_login'));
		return $this->load->view('admin/clients', $this->data);
	}
    
	public function rest() {
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $this->load->model('rest_type');
        $rest_type = $this->rest_typeModel->colInKey($this->rest_typeModel->getItems());
        
        $this->load->model('rest');
        
        if(isset($this->request->post['rem']))
            $this->restModel->deleteItems(array('id' => $this->request->post['id']));
        
        $rest = $this->restModel->getItems();
        
        $this->data['rest'] = $rest;
        
        $this->config->css = array('all', 'adm', 'adm_rest');
        $this->config->title = "ADM";
        $this->config->description = "Заведения";
		$this->getChild(array('common/header_admin', 'common/footer_login'));
		return $this->load->view('admin/rest', $this->data);
	}
    
	public function rest2() {
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $this->load->model('rest_type');
        $this->data['rest_type'] = $this->rest_typeModel->getItems();
        $this->load->model('city');
        $this->data['cities'] = $this->cityModel->getItems();
        
        $this->load->model('rest');
        
        if(isset($this->request->post['rem']))
            $this->restModel->deleteItems(array('id' => $this->request->post['id']));
        
        $this->data['rest'] = $this->restModel->getItems();     
        foreach($this->data['rest'] as $key => $rest){
            if(file_exists(APPLICATION_DIR . 'public/img/rests/' . $rest['id'] . ".png"))
                $logo_url = "/application/public/img/rests/" . $rest['id'] . ".png";
            else
                $logo_url = "/application/public/img/rest_logo.png";
            $this->data['rest'][$key]['logo_url'] = $logo_url;
        }
        
        $this->config->css = array('all', 'adm_all_rest');
        $this->config->title = "ADM";
        $this->config->description = "Список зведений";
		$this->getChild(array('common/header_admin', 'common/footer_login'));
		return $this->load->view('admin/rest2', $this->data);
	}
    
	public function payments($id = false) {
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $this->load->model('clients');
        $this->data['clients'] = $this->clientsModel->colInKey($this->clientsModel->getItems());
        
        $this->load->model('payments');
        
        if(isset($this->request->post['save'])){
            $date_fin = ($this->request->post['is_fin']?date('Y-m-d'):'');
            $this->paymentsModel->updateItems(array('phone' => $this->request->post['phone'],
                                                    'method' => $this->request->post['method'],
                                                    'amount' => $this->request->post['amount'],
                                                    'date_fin' => $date_fin),
                                              array('id' => $id));
        }
        if(isset($this->request->post['rem'])){
            $date_fin = ($this->request->post['is_fin']?date('Y-m-d'):'');
            $this->paymentsModel->updateItems(array('phone' => $this->request->post['phone'],
                                                    'method' => $this->request->post['method'],
                                                    'amount' => $this->request->post['amount'],
                                                    'date_fin' => $date_fin),
                                              array('id' => $id));
        }
        if($id){            
            $this->data['payment'] = $this->paymentsModel->getItems(array(), array('id' => $id))[0];
            $this->data['payment']['is_fin'] = ($this->data['payment']['date_fin'] == ''?'':'checked');
            $this->config->css = array('all', 'reg');
            $this->config->title = "ADM";
            $this->config->description = "Заявки на выплаты";
            $this->getChild(array('common/header_admin', 'common/footer_login'));
            return $this->load->view('admin/payments/edit', $this->data);
        }
        else{
            //$this->payment = $this->paymentsModel->getItems(array(), array('id' => 0));
            
            if(isset($this->request->post['hide_adm']))
                $this->paymentsModel->updateItems(array('hide_adm' => 1), array('id' => $this->request->post['id']));
            elseif(isset($this->request->post['ok'])){
                $this->paymentsModel->updateItems(array('date_fin' => date('Y-m-d')), array('id' => $this->request->post['id']));
                $payment = $this->paymentsModel->getItems(array(), array('id' => $this->request->post['id']))[0];
                $this_client = $this->clientsModel->getItems(array(), array('id' => $payment['cl_id']))[0];
                $this->clientsModel->updateItems(array('balance' => ($this_client['balance'] - $payment['amount']), 'cash' => ($this_client['cash'] - $payment['amount'])), array('id' => $payment['cl_id']));
            }
            $payments = $this->paymentsModel->getItems(array(), array('hide_adm' => 0));
            
            $pay_count = 0;
            foreach($payments as $key =>  $pay){
                if($pay['date_fin'] == ''){
                    $payments[$key]['status'] = $this->config->status_pay['1'];
                    $pay_count++;
                }
                else $payments[$key]['status'] = $this->config->status_pay['0'];
            }
            $this->data['payments'] = $payments;

            $this->data['pay_count'] = $pay_count;
            $this->config->css = array('all', 'adm', 'adm_req_pay');
            $this->config->title = "ADM";
            $this->config->description = "Заявки на выплаты";
            $this->getChild(array('common/header_admin', 'common/footer_login'));
            return $this->load->view('admin/payments/index', $this->data);
        }
	}
    
    public function cledit($id){
        
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $this->load->model('clients');
        if(isset($this->request->post['save'])){
            $this->clientsModel->updateItems(array('name' => $this->request->post['name'], 
                                                  'last_name' => $this->request->post['last_name'], 
                                                  'city' => $this->request->post['city'], 
                                                  'mail' => $this->request->post['mail'], 
                                                  'password' => $this->request->post['password'], 
                                                  'card' => $this->request->post['card'],
                                                  'cash' => $this->request->post['cash'], 
                                                  'balance' => $this->request->post['balance'], 
                                                  'visits' => $this->request->post['visits'], 
                                                  'phone' => $this->request->post['phone']), array('id' => $this->request->post['id']));
        }
        
        $this->data['client'] = $this->clientsModel->getItems(array(), array('id' => $id))[0];
        $this->load->model('city');
        $this->data['cities'] = $this->cityModel->getItems();
        
        $this->config->css = array('all', 'reg');
        $this->config->title = "ADM";
        $this->config->description = "Редактировать клиента";
		$this->getChild(array('common/header_admin', 'common/footer_login'));
		return $this->load->view('admin/cledit', $this->data);
    }
    
    public function getExcelAdmReservs(){
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $sql = "SELECT res.`id`, res.`date_st`, res.`date_fin`, res.`time`, rest.`type`, rest.`name`, rest.`city`, rest.`addr`, rest.`mail`, rest.`manager`, rest.`phone` as 'm_phone', res.`visiter`, res.`phone`, res.`hum_count`, res.`cost`, res.`is_undo`, res.`ok_rest`, res.`ok_adm` FROM `reservs` res, `rest` rest WHERE res.`rest_id` = rest.`id`";
        $file_name = 'rest_reservs';
        $col_name = array('ID', 'Дата регистрации', 'Дата резерва', 'Время резерва', 'Заведение', 'Название', 'Город', 'Адрес', 'E-mail', 'Менеджер', 'Номер менеджера', 'На кого резерв', 'Контактный номер', 'Количество людей', 'Стоимость резерва', 'Отмена', 'Подтверждение от заведения', 'Подтверждение от администратора');
        $arr = array(0 => $col_name);
        
        $this->load->model('reservs');
        $items = $this->reservsModel->query($sql);
        foreach($items as $item){
            $item['is_undo'] = ($item['is_undo'] == '1' ? 'Да' : 'Нет');
            $item['ok_rest'] = ($item['ok_rest'] == '1' ? 'Да' : 'Нет');
            $item['ok_adm'] = ($item['ok_adm'] == '1' ? 'Да' : 'Нет');
            $item['phone'] = $item['phone']." ";
            $item['m_phone'] = $item['m_phone']." ";
            $arr[] = $item;
        }
            
        $this->load->library('excel');
        $excel = new excelLibrary();
        $excel->getExcelByArr($arr, $file_name, 'Все резервы');
    }
    public function getExcelAdmRest(){
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $file_name = 'adm_rest';
        $col_name = array('ID', 'Дата регистрации', 'Название', 'Город', 'Адрес', 'E-mail', 'Пароль', 'Тип заведения', 'Менеджер', 'Номер менеджера', 'url сайта заведения', 'Описание', '% комиссии сервису', '% кешбека клиенту', 'Количество посещений', 'Общая сумма выплат');
        $arr = array(0 => $col_name);
        
        $this->load->model('rest');
        $items = $this->restModel->getItems();
        foreach($items as $item){
            $item['phone'] = $item['phone']." ";
            $arr[] = $item;
        }
            
        $this->load->library('excel');
        $excel = new excelLibrary();
        $excel->getExcelByArr($arr, $file_name, 'Все заведения');
    }
    public function getExcelAdmCl(){
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $file_name = 'adm_cl';
        $col_name = array('ID', 'Дата регистрации', 'Имя', 'Фамилия', 'Город', 'E-mail', 'Пароль', 'Номер карты Привата', 'Баланс', 'Доступно к выводу', 'Номер телефона', 'Количество посещений');
        $arr = array(0 => $col_name);
        
        $this->load->model('clients');
        $items = $this->clientsModel->getItems();
        foreach($items as $item){
            $item['phone'] = $item['phone']." ";
            $arr[] = $item;
        }
            
        $this->load->library('excel');
        $excel = new excelLibrary();
        $excel->getExcelByArr($arr, $file_name, 'Все клиенты');
    }
    public function getExcelAdmPays(){
        if(!$admin = $this->user->isAdmin()) $this->response->redirect('/');
        
        $sql = "SELECT pay.`id`, pay.`date_st`, pay.`date_fin`, cl.`last_name`, cl.`name`, cl.`mail`, cl.`balance`, cl.`cash`, pay.`amount`, pay.`card`, pay.`phone`, pay.`method` FROM `payments` pay, `clients` cl WHERE pay.`cl_id` = cl.`id`";
        $file_name = 'adm_payments';
        $col_name = array('ID', 'Дата регистрации заявки', 'Дата подтверждения администратором', 'Фамилия', 'Имя', 'E-mail', 'Баланс клиента', 'Доступно к выводу', 'Сумма к выводу из заявки', 'Номер карты Привата в заявке', 'Номер телефона в заявке', 'Метод вывода');
        $arr = array(0 => $col_name);
        
        $this->load->model('payments');
        $items = $this->paymentsModel->query($sql);
        foreach($items as $item){
            $item['phone'] = $item['phone']." ";
            $arr[] = $item;
        }
            
        $this->load->library('excel');
        $excel = new excelLibrary();
        $excel->getExcelByArr($arr, $file_name, 'Все заявки на выплаты');
    }
}
?>
