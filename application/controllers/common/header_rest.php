<?php

class header_restController extends Controller {

	public function index() {
                
        $this->data['title'] = $this->config->title;
        $this->data['description'] = $this->config->description;
        $this->data['keywords'] = $this->config->keywords;
		
		$this->data['activesection'] = $this->document->getActiveSection();
		$this->data['activeitem'] = $this->document->getActiveItem();

		if(isset($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}
		
		if(isset($this->session->data['warning'])) {
			$this->data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		}
		
		if(isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
        
        $this->data['css'] = $this->config->css;
        $this->data['notes'] = $notes;
        
        if($this->config->acc == 'cl') $this->data['client'];
        elseif($this->config->acc == 'adm') $this->data['admin'];
        elseif($this->config->acc == 'rest') $this->data['rest'];

		return $this->load->view('common/header_rest', $this->data);
	}
}
?>
