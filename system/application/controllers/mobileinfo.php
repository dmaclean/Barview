<?php
	class Mobileinfo extends CI_Controller {
		public function Mobileinfo() {
			parent::__construct();
			
			$this->config->load('facebook');
			
			$config['appId'] = $this->config->item('facebook_app_id');
			$config['secret'] = $this->config->item('facebook_api_secret');
			$config['cookie'] = true;
			
			$this->load->library('barviewusermanager', array('session' => $this->session));
			
			$this->load->helper('form');
		}
		
		public function index() {
			$this->barviewusermanager->processSession();
			
			// Make the facebook object available
			$data['facebook'] = $this->barviewusermanager->getFacebookObject();
			
			$data['no_hero'] = true;
		
			$this->load->view('includes/user_header', $data);
			$this->load->view('mobileinfo_view', $data);
			$this->load->view('includes/footer', $data);
		}
	}
?>