<?php
	require_once 'facebook-php-sdk/src/facebook.php';

	class About extends CI_Controller {
		public function About() {
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
		
			if($this->barviewusermanager->isBar())
				$this->load->view('includes/header', $data);
			else
				$this->load->view('includes/user_header', $data);
			$this->load->view('about_view', $data);
			$this->load->view('includes/footer', $data);
		}
	}
?>