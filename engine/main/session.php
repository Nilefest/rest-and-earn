<?php

class Session {
	public $data = array();
			
  	public function __construct() {
		if(!session_id()) session_start();
		$this->data = &$_SESSION;
	}
    
    public function add($name, $value){
        $this->data[$name]->$value;
        $_SESSION[$name]=$value;
    }
    public function rem($name){
        unset($this->data[$name]);
        unset($_SESSION[$name]);
    }
}
?>
