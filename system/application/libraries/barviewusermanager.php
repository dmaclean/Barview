<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require_once 'facebook.php';

	class Barviewusermanager {
		
		private $session;
		private $fb_logout;
		private $CI;
		private $config;
	
		public function __construct($params) {
			$this->CI =& get_instance();
			$this->CI->load->config('facebook');
			$this->CI->load->library('facebook');
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
		
		public function processSession() {
			log_message("debug", "Processing the session");
		
			// Check if we already have a session.  If so, get out.
			if($this->session->userdata('uid')) {
				log_message("debug", "We already have a session for ".$this->session->userdata('uid')." so there's nothing to do in processSession.");
				return;
			}
			
			delete_cookie("fbs_".$this->CI->config->item('facebook_app_id'));
			
			// Get User ID
			$user = $this->CI->facebook->getSession();
			
			$user_profile = null;
			
			// We may or may not have this data based on whether the user is logged in.
			//
			// If we have a $user id here, it means we know the user is logged into
			// Facebook, but we don't know if the access token is valid. An access
			// token is invalid if the user logged out of Facebook.
			if($user) {
				try {
					$user_profile = $this->CI->facebook->api('/me');
					
					//print_r($user_profile);
					//print_r($user);
					
					// Set up our session
					$this->session->set_userdata('usertype', FACEBOOK_TYPE);
					$this->session->set_userdata('uid', $user['uid']);
				}
				catch (FacebookApiException $e) {
					error_log($e);
					$user = null;
				}
			}
		}
	}
?>