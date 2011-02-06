<?php
	class Logon extends Controller {
		function Logon() {
			parent::Controller();
			$this->load->library('form_validation');
			
			$this->load->scaffolding('users');
			
			$this->load->helper('form');
			
			$config['appId'] = '177771455596726';
			$config['secret'] = '673c8bee019e397e296d9a47b6a5e9c3';
		}
	
		public function index() {
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if(!isset($is_logged_in) || $is_logged_in != true) {	// Can't use !== because the cookie is stored as 0/1, not true/false.
				$data['bar_owner'] = true;
			
				//$data['main_content'] = 'logon_view';
				//$this->load->view('/includes/header', $data);
				$this->load->view('logon_view', $data);
				//$this->load->view('/includes/footer', $data);
			}
			else {
				redirect('/home');
			}
		}
		
		public function submit() {
			if($this->_submit_validation() === FALSE) {
				die('validation failed');
				$this->index();
				return;
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
		
		public function authenticate() {
			$this->load->model('user_model');
			$auth_result = $this->user_model->validate();
			
			//$id 	= $this->db->escape($this->input->post('username'));
			//$pass 	= $this->db->escape($this->input->post('password'));
		
			//$sql = 'select * from users where id = '.$id.' and pass = '.$pass;
			//$query = $this->db->query($sql);
			
			//if($query->num_rows() == 1) {
			if($auth_result) {
				// Create session
				$data = array (
					'username' => $this->input->post('username'),
					'is_logged_in' => TRUE,
				);
				
				//$row = $query->row();
				//if($row->type == 'bar') {
				if($this->user_model->get_type() == 'bar') {
					$data['bar_owner'] = true;
					$data['bar_id'] = $this->user_model->get_bar_id();
				}
				
				$this->session->set_userdata($data);
				
				return true;
			}
			
			return false;
		}
	}
?>