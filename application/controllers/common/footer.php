<?php

class footerController extends Controller {
	public function index() {
                   
        $this->data['js'] = $this->config->js;
        
		return $this->load->view('common/footer', $this->data);
	}
}
?>
