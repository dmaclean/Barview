<?php
	class Signup extends Controller {
		function Signup() {
			parent::Controller();
			$this->load->library('form_validation');
			
			$this->load->helper('form');
		}
		
		function index() {
			$data['main_content'] = 'signup_view';
			$this->load->view('/includes/template', $data);	
		}
		
		function submit() {
			// Perform input validation.
			if($this->_submit_validation() == false) {
				$this->index();
				return;
			}
			
			$this->load->model('user_model');
			$this->user_model->set_username($this->input->post('username'));
			$this->user_model->set_password($this->input->post('password'));
			$this->user_model->set_realname($this->input->post('name'));
			$this->user_model->set_email($this->input->post('email'));
			$this->user_model->set_type($this->input->post('type'));
			
			// Account info looks good.  Insert into the database.
			$this->user_model->create();
			
			// Send the user back to the logon page.
			$data['create_message'] = '';
			redirect('');
		}
		
		private function _submit_validation() {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password_conf]');
			$this->form_validation->set_rules('password_conf', 'Confirm password', 'required');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('type', 'Account Type', 'trim|required');
			
			return $this->form_validation->run();
		}
		
		public function check_username_exists($username) {
			$this->load->model('user_model');

			if($this->user_model->username_exists($username)) {
				$this->form_validation->set_message('check_username_exists', 'The username '.$username.' is already in use.');
				return false;
			}
			else {
				return true;
			}
		}
	}
?>