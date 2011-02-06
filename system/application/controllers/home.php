<?php 
	class Home extends Controller {
		function Home() {
			parent::Controller();
			
			$config['appId'] = '177771455596726';
			$config['secret'] = '673c8bee019e397e296d9a47b6a5e9c3';
			$config['cookie'] = true;
			
			//load Facebook php-sdk library with $config[] options
			$this->load->library('facebook', $config); 
			
			$this->load->helper('form');
		}
	
		function index() {
			$data['fb_app_id'] = $this->facebook->getAppId();
		
			//$is_logged_in = $this->session->userdata('is_logged_in');
			$session = $this->facebook->getSession();
			$data['fb_session'] = $session;
			
			$me = null;
			if($session) {
				echo 'We have a session';
				try {
					$uid = $this->facebook->getUser();
					$me = $this->facebook->api('/me');
					
					$data['fb_uid'] = $uid;
				}
				catch(FacebookApiException $e) {
					error_log($e);
				}
			}
			
			$data['fb_me'] = $me;
			
			if($me) {
				$data['fb_logon'] = $this->facebook->getLogoutUrl();
			}
			else {
				$data['fb_logon'] = $this->facebook->getLoginUrl();
			}
			
			/*
			 * Load the favorites
			 */
			if(isset($data['fb_uid']))
				$data['favorites'] = $this->getFavorites($data['fb_uid']);
			
			// Send bars to home_bar
			if($this->session->userdata('bar_id')) {
				$data['bar_id'] = $this->session->userdata('bar_id');
				//$this->load->view('includes/header', $data);
				$this->load->view('home_bar_view', $data);
				//$this->load->view('includes/footer', $data);
				
			}
			// Send users to home.
			//if(isset($data['fb_uid']))
			else {
				//$this->load->view('includes/header', $data);
				$this->load->view('home_view', $data);
				//$this->load->view('includes/footer', $data);
			}
		}
		
		private function getFavorites($uid) {
			$faves = array();
			
			$clean_uid = $this->db->escape($uid);
		
			$sql = 'select bar_id from favorites where user_id = '.$clean_uid;
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$this->load->model('bar_model');
				$this->bar_model->select($row->bar_id);
				
				// Add to a list
				$faves[] = array('id' => $this->bar_model->get_bar_id(), 'name' => $this->bar_model->get_name());//$this->bar_model;
			}

			return $faves;
		}
	}
?>