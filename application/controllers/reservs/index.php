<?php

class indexController extends Controller {
    
	public function index() {
        $this->response->redirect('/reservs/creat');
	}
    
	public function creat() {
        if(empty($this->user->isAdmin()) && empty($this->user->isRest()) && empty($this->user->isClient())) 
            $this->response->redirect('/');
        $this->load->model('rest_type');
        $this->data['rest_type'] = $this->rest_typeModel->getItems();
        
        $this->load->model('city');
        $this->data['city'] = $this->cityModel->getItems();
        
        $this->load->model('rest');
        $this->data['rest'] = $this->restModel->getItems();
        
            $this->load->model('reservs');
        if(isset($this->request->post['new'])){
            
            $per = array('per_client' => 0, 'per_coop' => 0);
            $this->load->model('rest');
            $per = $this->restModel->getItems(array('per_cl', 'per_coop'), array('id' => $this->request->post['rest_id']))[0]; 
            
            $this->reservsModel->addItem(array('date_st' => date('Y-m-d'),
                                               'date_fin' => $this->request->post['date_fin'],
                                               'time' => $this->request->post['time'],
                                               'rest_id' => $this->request->post['rest_id'],
                                               'hum_count' => $this->request->post['hum_count'],
                                               'cl_id' => $this->user->isClient()['id'],
                                               'visiter' => $this->request->post['visiter'],
                                               'phone' => $this->request->post['phone'],
                                               'per_cl' => $per['per_cl'],
                                               'per_coop' => $per['per_coop']
                                        ));
            
            $this->mail->sendNewReserv($this->restModel->getItems(array(), array('id' => $this->request->post['rest_id']))[0],
                                      $this->reservsModel->getItems(array(), array('id' => $this->reservsModel->getMax()))[0]);
            
            if(!empty($this->user->isAdmin()))
                $this->response->redirect('/admin');
            if(!empty($this->user->isRest()))
                $this->response->redirect('/rest');
            else
                $this->response->redirect('/client/reservs');
        }
        
        $this->load->model('clients');
        $this->data['client'] = $this->user->isClient();
        $this->data['rest_id'] = $this->user->isRest()['id'];
        
        $this->config->css = array('all', 'new_reserv');
        $this->config->description = "Новый резерв";
		$this->getChild(array('common/header', 'common/footer_login'));
		return $this->load->view('reservs/creat', $this->data);
	}
    
	public function edit($id = false) {
        if(!id) $this->response->redirect('/reservs/creat');
        if(empty($admin = $this->user->isAdmin()) && empty($rest = $this->user->isRest())) $this->response->redirect('/rest');
        
        $this->load->model('reservs');
        $reserv = $this->reservsModel->getItems(array(), array('id' => $id))[0];
        
        $this->load->model('rest_type');
        $this->data['rest_type'] = $this->rest_typeModel->getItems();
        
        $this->load->model('city');
        $this->data['city'] = $this->cityModel->getItems();
        
        $this->load->model('rest');
        $this->data['rest'] = $this->restModel->getItems();
             
        if(isset($this->request->post['save'])){
            
            $this->load->model('reservs');
            $this->reservsModel->updateItems(array('date_st' => date('Y-m-d'),
                                               'date_fin' => $this->request->post['date_fin'],
                                               'time' => $this->request->post['time'],
                                               'rest_id' => $this->request->post['rest_id'],
                                               'hum_count' => $this->request->post['hum_count'],
                                               'cl_id' => $this->request->post['cl_id'],
                                               'visiter' => $this->request->post['visiter'],
                                               'phone' => $this->request->post['phone'],
                                               'cost' => $this->request->post['cost'],
                                               'per_cl' => $this->request->post['per_cl'],
                                               'per_coop' => $this->request->post['per_coop']
                                        ), array('id' => $id));
            $reserv = $this->reservsModel->getItems(array(), array('id' => $id))[0];
        }
        
        $this->data['client'] = $client;
        $this->data['rest_id'] = $rest_id;
        $this->data['reserv'] = $reserv;
        
        if(!empty($this->user->isAdmin())) $this->data['adm'] = 1;
        else $this->data['adm'] = 0;
        
        $this->config->css = array('all', 'new_reserv');
        $this->config->description = "Редактировать резерв";
		$this->getChild(array('common/header', 'common/footer_login'));
		return $this->load->view('reservs/edit', $this->data);
	}
}
?>
