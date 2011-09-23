<?php
	class Logout extends CI_Controller {
		function Logout() {
			parent::__construct();
			
			$this->config->load('facebook');
			
			$config['appId'] = $this->config->item('facebook_app_id');
			$config['secret'] = $this->config->item('facebook_api_secret');
			$config['cookie'] = true;
			
			$this->load->library('facebook', $config);
		}
		
		function index() {
			/*
			 * We're logging out a Facebook user.
			 */
			if($this->session->userdata('usertype') == FACEBOOK_TYPE) {
				$this->facebook->setSession(null);
				log_message("debug", "Logout - set facebook session to null.");
				
			}
		
			log_message("debug", "Logout - about to destroy the session.");
			$this->session->unset_userdata(array('uid' => '', 'usertype' => ''));
			$this->session->sess_destroy();

			redirect('/home');
		}
	}
?>