<?php

class indexController extends Controller {
	public function index() {
        
        if($this->request->post['new_pass'])
            $this->mail->sendPass( $this->request->post['mail'] );
        
        $this->config->css = array('all', 'main');
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('main/index', $this->data);
	}
}
?>