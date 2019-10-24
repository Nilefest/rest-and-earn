<?php

class indexController extends Controller {
    
	public function index() {
        if(isset($this->request->post['reg'])){
            $this->load->model('rest');
            $this->restModel->addItem(array('date_reg' => date('Y-m-d'),
                                            'name' => $this->request->post['name'],
                                            'city' => $this->request->post['city'],
                                            'addr' => $this->request->post['addr'],
                                            'mail' => $this->request->post['mail'],
                                            'password' => $this->request->post['password'],
                                            'type' => $this->request->post['type'],
                                            'per_coop' => $this->request->post['per_coop'],
                                            'manager' => $this->request->post['manager'],
                                            'phone' => $this->request->post['phone'], 
                                            'url' => $this->request->post['url'], 
                                            'description' => $this->request->post['description']));/**/
            $this->mail->sendNewRest($this->request->post['name'], $this->request->post['mail']);
            
            // load file for logo
            if(!empty($this->request->files['file_logo']['tmp_name'])){
                $max_id = $this->restModel->getMax();
                copy($this->request->files['file_logo']['tmp_name'], APPLICATION_DIR."public/img/rests/".$max_id.".png");
            }
            // re-log
            $this->user->loginRest($this->request->post['mail'], $this->request->post['password']);
        }
        
        if(isset($this->request->post['log-in']))
            $this->user->loginRest($this->request->post['mail'], $this->request->post['password']);
        if(empty($this->user->isRest())) $this->response->redirect('/');
        $this->response->redirect('/rest/reservs');
	}
    
	public function reg() {
        $this->config->description = "Зареестрироваться как заведение";
            
        $this->load->model('rest_type');
        $this->data['rest_type'] = $this->rest_typeModel->getItems();
        
        $this->load->model('city');
        $this->data['cities'] = $this->cityModel->getItems();
        
        if(isset($this->request->post['reg_rest'])){
            $this->data['mail'] = $this->request->post['mail'];
            $this->data['password'] = $this->request->post['password'];
        }
        
        $this->config->css = array('all', 'reg');
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('rest/reg', $this->data);
	}
    
    public function reservs(){
        if(!$rest = $this->user->isRest()) $this->response->redirect('/');
        
        $this->load->model('reservs');
        $this_rest = $this->reservsModel->getItems(array(), array('id' => $this->request->post['id']))[0];
        if(isset($this->request->post['canc']))
            if($this_rest['ok_adm'] != 1){
                $this->reservsModel->updateItems(array('is_undo' => 1), array('id' => $this->request->post['id']));
                $this->mail->sendCancReserv($this->reservsModel->getItems(array(), array('id' => $this->request->post['id']))[0], $this->request->post['amount']);
                return true;
            }
        if(isset($this->request->post['rem'])){
            $this->reservsModel->updateItems(array('hide_rest' => 1), array('id' => $this->request->post['id']));
            return true;
        }
        if(isset($this->request->post['ok'])){
            $this->reservsModel->updateItems(array('ok_rest' => 1), array('id' => $this->request->post['id']));
            return true;
        }
        
        $reservs = $this->reservsModel->getItems(array(), array('hide_rest' => 0, 'rest_id' => $rest['id']));
        foreach($reservs as $key => $reserv){
            $total_cost += $reserv['cost'];
            $total_cash += $reserv['cost'] / 100 * $reserv['per_coop'];
            
            
            if($reserv['is_undo'] == '1')                               // ОТМЕНЕНО, если отменено
                $reservs[$key]['status'] = $this->config->status_reserv[3];
            elseif($reserv['date_fin'] > date('Y-m-d'))                 // В ПРОЦЕССЕ, если дата не наступила
                $reservs[$key]['status'] = $this->config->status_reserv[2];
            elseif($reserv['ok_adm'] == '1')                            // ЗАВЕРШЕНО, если администратор нажал завершить
                $reservs[$key]['status'] = $this->config->status_reserv[0];
            elseif($reserv['cost'] == 0 || $reserv['per_coop'] == 0)    // НЕ ХВАТАЕТ ДАННЫХ, если дата наступила, а не указано сумма по чеку ил  процент комиссии
                $reservs[$key]['status'] = $this->config->status_reserv[1];
            elseif($reserv['date_fin'] < date('Y-m-d'))                 // ЗАВЕРШЕНО, если дата прошла и указана сумма по чеку и процент комиссии
                $reservs[$key]['status'] = $this->config->status_reserv[0];
            
            if($reserv['ok_adm'] == '1') $reservs[$key]['status_end'] = $this->config->status_end['ok_adm'];
            elseif($reserv['ok_rest'] == '1') $reservs[$key]['status_end'] = $this->config->status_end['ok_rest'];
            
        }
        $this->data['reservs'] = $reservs;
        $this->data['total_cost'] = $total_cost;
        $this->data['total_cash'] = $total_cash;
        
        $this->config->description = "Резервы";
        $this->config->css = array('all', 'adm', 'rest_cab');
		$this->getChild(array('common/header_rest', 'common/footer_login'));
		return $this->load->view('rest/reservs', $this->data);
    }
    
	public function edit() {
        if(!$rest = $this->user->isRest()) $this->response->redirect('/');
        
        $this->load->model('rest');
        if(isset($this->request->post['save'])){
            $this->restModel->updateItems(array('name' => $this->request->post['name'],
                                                'city' => $this->request->post['city'],
                                                'addr' => $this->request->post['addr'],
                                                'mail' => $this->request->post['mail'],
                                                'password' => $this->request->post['password'],
                                                'type' => $this->request->post['type'],
                                                'per_coop' => $this->request->post['per_coop'],
                                                'per_cl' => $this->request->post['per_cl'],
                                                'manager' => $this->request->post['menager'], 
                                                'phone' => $this->request->post['phone'], 
                                                'url' => $this->request->post['url'], 
                                                'description' => $this->request->post['description']), 
                                          array('id' => $this->request->post['id']));
            // load file for logo
            if(!empty($this->request->files['file_logo']['tmp_name'])){
                copy($this->request->files['file_logo']['tmp_name'], APPLICATION_DIR."public/img/rests/".$this->request->post['id'].".png");
            }
            // re-log
            $this->user->loginRest($this->request->post['mail'], $this->request->post['password']);
        }
        $this->data['rest'] = $this->user->isRest();
            
        $this->load->model('rest_type');
        $this->data['rest_type'] = $this->rest_typeModel->getItems();
        
        $this->load->model('city');
        $this->data['cities'] = $this->cityModel->getItems();
        
        if(!empty($this->user->isAdmin())) $this->data['adm'] = 1;
        else $this->data['adm'] = 0;
        
        $this->config->description = "Редактировать заведение";
        $this->config->css = array('all', 'reg');        
		$this->getChild(array('common/header_rest', 'common/footer_login'));
		return $this->load->view('rest/edit', $this->data);
	}
    
    public function byType(){
        if(!isset($this->request->post['type'])) $this->response->redirect('/');
        
        $this->load->model('rest');
        $rest = $this->restModel->getItems(array('id', 'name', 'type', 'city', 'addr', 'description', 'per_cl'), array('type' => $this->request->post['type']));
        print_r(json_encode($rest));
    }
    
    public function byCity(){
        if(!isset($this->request->post['city'])) $this->response->redirect('/');
        
        $this->load->model('rest');
        $rest = $this->restModel->getItems(array('id', 'name', 'type', 'city', 'addr', 'description', 'per_cl'), array('city' => $this->request->post['city']));
        print_r(json_encode($rest));
    }
    
    public function getExcelRestReservs(){
        if(!$rest = $this->user->isRest()) $this->response->redirect('/');
        $rest_id = $rest['id'];
        $sql = 'SELECT res.`id`, res.`date_st`, res.`date_fin`, res.`time`, res.`visiter`, res.`phone`, res.`hum_count`, res.`cost`, res.`is_undo`, res.`ok_rest`, res.`ok_adm` FROM `reservs` res WHERE res.`rest_id` = '.$rest_id;
        
        $file_name = 'rest_reservs';
        $col_name = array('ID', 'Дата регистрации', 'Дата резерва', 'Время резерва', 'На кого резерв', 'Контактный номер', 'Количество людей', 'Стоимость резерва', 'Отмена', 'Подтверждение от заведения', 'Подтверждение от администратора');
        $arr = array(0 => $col_name);
        
        $this->load->model('reservs');
        $items = $this->reservsModel->query($sql);
        foreach($items as $item){
            $item['is_undo'] = ($item['is_undo'] == '1' ? 'Да' : 'Нет');
            $item['ok_rest'] = ($item['ok_rest'] == '1' ? 'Да' : 'Нет');
            $item['ok_adm'] = ($item['ok_adm'] == '1' ? 'Да' : 'Нет');
            $item['phone'] = $item['phone']." ";
            $arr[] = $item;
        }
        
        $this->load->library('excel');
        $excel = new excelLibrary();
        $excel->getExcelByArr($arr, $file_name, 'Резервы заведения');
    }
}
?>