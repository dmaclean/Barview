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
			redirect('/home');
		}
		
		public function submit() {
			if($this->_submit_validation() == FALSE) {
				$this->session->set_flashdata('error_msg', "Invalid login.  Please try again.<br/><br/>Please note that if your registration has not been verified yet then you won't be able to log in.");
				redirect('/barhome');
			}
			
			redirect('/barhome');
		}
		
		/**
		 * This isn't used.  I think we can get rid of it.
		 */
		/*public function logoff() {
			$this->session->sess_destroy();
			
			redirect('/home');
		}*/
		
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
					'is_logged_in' => TRUE,							// Do we need this?
					'bar_id' => $this->bar_model->get_bar_id(),
					'bar_name' => $this->bar_model->get_name()
				);
				
				$this->session->set_userdata($data);
				$this->record_session_data($this->session->userdata('session_id'), $this->bar_model->get_name());
				
				return true;
			}
			
			return false;
		}
	}
?>