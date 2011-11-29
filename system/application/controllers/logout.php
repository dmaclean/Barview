<?php

	require 'facebook-php-sdk/src/facebook.php';

	class Logout extends CI_Controller {
	
		function Logout() {
			parent::__construct();
			
			$this->config->load('facebook');
			
			$config['appId'] = $this->config->item('facebook_app_id');
			$config['secret'] = $this->config->item('facebook_api_secret');
			$config['cookie'] = true;
		}
		
		function index() {
			/*
			 * We're logging out a Facebook user.
			 */
			if($this->session->userdata('usertype') == FACEBOOK_TYPE) {
				$facebook = new Facebook(array(
				  'appId'  => $this->config->item('facebook_app_id'),
				  'secret' => $this->config->item('facebook_api_secret'),
				));
			
				$facebook->destroySession();
				log_message("debug", "Logout - set facebook session to null.");
				
			}
			
			/*
			 * Is this a bar?  If so, redirect them back to the bar landing page.
			 */
			$redirect = 'home';
			if($this->session->userdata('bar_id'))
				$redirect = 'barhome';
				
		
			log_message("debug", "Logout - about to destroy the session.");
			$this->session->unset_userdata(array('uid' => '', 'usertype' => ''));
			$this->session->sess_destroy();

			redirect($redirect);
		}
	}
?>