<?php
class User {
	private $registry;
    
	private $client = array();
	private $rest = array();
	private $admin = array();

  	public function __construct($registry) {
		$this->registry = $registry;
        $this->loggedClient();
        $this->loggedRest();
        $this->loggedAdmin();
  	}

    public function loginClient($login, $pass){
        $this->registry->session->add('re_cl_mail', $login);
        $this->registry->session->add('re_cl_pass', $pass);
		$this->loggedClient();
    }
    public function loginRest($login, $pass){
        $this->registry->session->add('re_rest_mail', $login);
        $this->registry->session->add('re_rest_pass', $pass);
		$this->loggedRest();
    }
    public function loginAdmin($login, $pass){
        $this->registry->session->add('re_adm_mail', $login);
        $this->registry->session->add('re_adm_pass', $pass);
		$this->loggedAdmin();
    }
    
    private function loggedClient(){
		if (isset($this->registry->session->data['re_cl_mail'])) {
			$query = $this->registry->db->query("SELECT * FROM `clients` WHERE mail = '".$this->registry->session->data['re_cl_mail']."' AND password = '".$this->registry->session->data['re_cl_pass']."'");
            if(!empty($query)) $this->client = $query[0];
            else $this->logoutClient();
        }
    }
    private function loggedRest(){
		if (isset($this->registry->session->data['re_rest_mail'])) {
			$query = $this->registry->db->query("SELECT * FROM `rest` WHERE `mail` = '".$this->registry->session->data['re_rest_mail']."' AND `password` = '".$this->registry->session->data['re_rest_pass']."'");
            if(!empty($query)) $this->rest = $query[0];
            else $this->logoutRest();
        }
    }
    private function loggedAdmin(){
		if (isset($this->registry->session->data['re_adm_mail'])) {
			$query = $this->registry->db->query("SELECT * FROM `admin` WHERE mail = '".$this->registry->session->data['re_adm_mail']."' AND password = '".$this->registry->session->data['re_adm_pass']."'");
            if(!empty($query)) $this->admin = $query[0];
            else $this->logoutAdmin();
        }
    }
    
  	public function logout($account = false) {
        if($account == 'cl') $this->logoutClient();
        elseif($account == 'rest') $this->logoutRest();
        elseif($account == 'adm') $this->logoutAdmin();
        else{
            $this->logoutClient();
            $this->logoutRest();
            $this->logoutAdmin();
        }
    }
    
  	public function logoutClient() {
		$this->registry->session->rem('re_cl_mail');
		$this->registry->session->rem('re_cl_pass');
        $this->client = array();
  	}
    public function logoutRest() {
		$this->registry->session->rem('re_rest_mail');
		$this->registry->session->rem('re_rest_pass');
    
        $this->rest = array();
  	}
    public function logoutAdmin() {
		$this->registry->session->rem('re_adm_mail');
		$this->registry->session->rem('re_adm_pass');
	
        $this->admin = array();
  	}
  
  	public function isClient() {
        return $this->client;
  	}
  	public function isRest() {
        return $this->rest;
  	}
  	public function isAdmin() {
        return $this->admin;
  	}
}
?>