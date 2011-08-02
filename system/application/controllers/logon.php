<?php
	class Logon extends CI_Controller {
		function Logon() {
			parent::__construct();
			$this->load->library('form_validation');
			
			$this->load->helper('form');
			
			$config['appId'] = '177771455596726';
			$config['secret'] = '673c8bee019e397e296d9a47b6a5e9c3';
		}
	
		public function index() {
			/*$is_logged_in = $this->session->userdata('is_logged_in');
			
			if(!isset($is_logged_in) || $is_logged_in != true) {	// Can't use !== because the cookie is stored as 0/1, not true/false.
				$data['bar_owner'] = true;
			
				//$data['main_content'] = 'logon_view';
				//$this->load->view('/includes/header', $data);
				$this->load->view('logon_view', $data);
				//$this->load->view('/includes/footer', $data);
			}
			else {*/
				redirect('/home');
			//}
		}
		
		public function submit() {
			if($this->_submit_validation() === FALSE) {
				//die('validation failed');
				//$this->index();
				//return;
				redirect('/home');
			}
			
			redirect('/home');
		}
		
		public function logoff() {
			$this->session->sess_destroy();
			
			redirect('/home');
		}
		
		private function _submit_validation() {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_authenticate');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_message('authenticate', 'Invalid login.  Please try again.');
			
			return $this->form_validation->run();
		}
		
		private function record_session_data($session_id, $username) {
			$sql = 'update ci_sessions set bar_name = '.$this->db->escape($username).' where session_id = '.$this->db->escape($session_id);
			$this->db->query($sql);
		}
		
		public function authenticate() {
			$this->load->model('bar_model');
			$auth_result = $this->bar_model->validate();
			
			if($auth_result) {
				// Create session
				$data = array (
					'username' => $this->input->post('username'),	// Do we need this?
					'is_logged_in' => TRUE,							// Do we need this?
					'bar_id' => $this->bar_model->get_bar_id(),
					'bar_name' => $this->bar_model->get_name(),
					'bar_owner' => true								// Do we need this?
				);
				
				$this->session->set_userdata($data);
				$this->record_session_data($this->session->userdata('session_id'), $this->bar_model->get_name());
				
				return true;
			}
			
			return false;
		}
	}
?>