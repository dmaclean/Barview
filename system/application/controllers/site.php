<?php 
	class Site extends CI_Controller {
		function Site() {
			parent::__construct();
			
			$this->is_logged_in();
		}
		
		function index() {
			$data['main_content'] = 'home';
			$this->load->view('includes/template', $data);
		}
		
		private function is_logged_in() {
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if(!isset($is_logged_in) || $is_logged_in !== true) {
				$data['main_content'] = 'logon_view';
				$this->load->view('/includes/template', $data);	
			}
			else {
				$this->index();
			}
		}
	}
?>