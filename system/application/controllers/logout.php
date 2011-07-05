<?php
	class Logout extends CI_Controller {
		function Logout() {
			parent::__construct();
		}
		
		function index() {
			$this->session->sess_destroy();
			
			redirect('/home');
		}
	}
?>