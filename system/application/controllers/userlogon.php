<?php
	class UserLogon extends CI_Controller {
		function UserLogon() {
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
			if($this->_submit_validation() === FALSE) {
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect('/home');
			}
			
			redirect('/home');
		}
		
		public function logoff() {
			$this->session->sess_destroy();
			
			redirect('/home');
		}
		
		private function _submit_validation() {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_authenticate');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_message('authenticate', 'Invalid login.  Please try again.');
			
			return $this->form_validation->run();
		}
		
		private function record_session_data($session_id, $uid) {
			$sql = 'update ci_sessions set bar_name = '.$this->db->escape($uid).' where session_id = '.$this->db->escape($session_id);
			$this->db->query($sql);
		}
		
		public function authenticate() {
			$this->load->model('user_model');
			$auth_result = $this->user_model->validate();
			
			if($auth_result) {
				// Create session
				$data = array (
					'uid' => $this->input->post('email'),
					'usertype' => BARVIEW_TYPE,
					'is_logged_in' => TRUE
				);
				
				$this->session->set_userdata($data);
				$this->record_session_data($this->session->userdata('session_id'), $this->user_model->get_user_id());
				
				return true;
			}
			
			return false;
		}
	}
?>