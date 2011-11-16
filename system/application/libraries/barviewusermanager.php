<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Barviewusermanager {
		
		private $session;
		private $fb_logout;
		private $CI;
		private $config;
		
		private $facebook;
	
		public function __construct($params) {
			$this->CI =& get_instance();
			$this->CI->load->config('facebook');
			
			$this->CI->load->helper('cookie');
			
			$config = array(	'facebook_app_id' => $this->CI->config->item('facebook_app_id'), 'facebook_api_secret' => $this->CI->config->item('facebook_api_secret'), 'cookie' => true);

			$this->session = $params['session'];
		}
	
		public function getUserType() {
			return $this->session->userdata('usertype');
		}
		
		public function getUserId() {
			return $this->session->userdata('uid');
		}
		
		public function isLoggedIn() {
			return $this->session->userdata('usertype');
		}
		
		public function hasFacebookSession() {
			if($this->session->userdata('usertype') == FACEBOOK_TYPE)
				return true;
				
			return false;
		}
		
		public function hasBarviewSession() {
			if($this->session->userdata('usertype') == BARVIEW_TYPE)
				return true;
				
			return false;
		}
		
		public function getFacebookObject() {
			return $this->facebook;
		}
		
		public function processSession() {
			log_message("debug", "Processing the session");
			
			// Create our Application instance (replace this with your appId and secret).
			// We need to instantiate this before the session check below, otherwise the
			// session will be detected but the facebook object won't have been initialized.
			$facebook = new Facebook(array(
			  'appId'  => $this->CI->config->item('facebook_app_id'),
			  'secret' => $this->CI->config->item('facebook_api_secret')
			));
			$this->facebook = $facebook;
		
			// Check if we already have a session.  If so, get out.
			if($this->session->userdata('uid')) {
				log_message("debug", "We already have a session for ".$this->session->userdata('uid')." so there's nothing to do in processSession.");				
				return;
			}
			
			// Get User ID
			$user = $facebook->getUser();
			
			// We may or may not have this data based on whether the user is logged in.
			//
			// If we have a $user id here, it means we know the user is logged into
			// Facebook, but we don't know if the access token is valid. An access
			// token is invalid if the user logged out of Facebook.
			if ($user) {
				try {
					// Proceed knowing you have a logged in user who's authenticated.
					$user_profile = $facebook->api('/me');
					
					// Set up our session
					$this->session->set_userdata('usertype', FACEBOOK_TYPE);
					$this->session->set_userdata('uid', $user['uid']);
			  	} catch (FacebookApiException $e) {
					error_log($e);
					$user = null;
			  	}
			}
		}
	}
?>