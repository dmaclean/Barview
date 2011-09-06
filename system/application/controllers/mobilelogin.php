<?php
	class MobileLogin extends CI_Controller {
		public function MobileLogin() {
			parent::__construct();
			
			$this->load->model('user_model');
		}
		
		public function index() {
			$user = $_SERVER['HTTP_BV_USERNAME'];
			$pass = $_SERVER['HTTP_BV_PASSWORD'];
			log_message("debug", "Attempting to log user in with credentials ".$user." - ".$pass);
			
			$this->user_model->set_user_id($user);
			$this->user_model->set_password($pass);
			
			log_message("debug", "About to execute login");
			$xml = $this->user_model->mobile_login($user, $pass);
			log_message("debug", "Done executing login");
			
			echo $xml;
		}
		
		public function logout() {
			$token = $_SERVER['HTTP_BV_TOKEN'];
			log_message("debug","Attempting to log out user with token ".$token);
			
			$this->user_model->mobile_logout($token);
		}
	}
?>