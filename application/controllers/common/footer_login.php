<?php

class footer_loginController extends Controller {
	public function index() {
                   
        $this->data['js'] = $this->config->js;
        
		return $this->load->view('common/footer_login', $this->data);
	}
}
?>
