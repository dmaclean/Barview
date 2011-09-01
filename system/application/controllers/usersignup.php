<?php
	class UserSignup extends CI_Controller {
		function UserSignup() {
			parent::__construct();
			$this->load->library('form_validation');
			
			$this->load->helper('form');
		}
		
		function index() {
			$data['main_content'] = 'user_signup_view';
			$this->load->view('/includes/template', $data);	
		}
		
		function submit() {
			// Perform input validation.
			if($this->_submit_validation() == false) {
				$this->index();
				return;
			}
			
			$this->load->model('user_model');
			
			$this->user_model->set_first_name($this->input->post('first_name'));
			$this->user_model->set_last_name($this->input->post('last_name'));
			$this->user_model->set_email($this->input->post('email'));
			$this->user_model->set_password($this->input->post('password'));
			$this->user_model->set_dob(date('m/d/y'));
			$this->user_model->set_city($this->input->post('city'));
			$this->user_model->set_state($this->input->post('state'));
			
			$this->user_model->create();
			
			$this->send_registration_email($this->user_model->get_email());
			
			// Send the user back to the logon page.
			$data['create_message'] = '';
			redirect('');
		}
		
		private function _submit_validation() {
			$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password_conf]');
			$this->form_validation->set_rules('password_conf', 'Confirm password', 'required');
			//$this->form_validation->set_rules('dob', 'Date of Birth', );
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
			
			
			return $this->form_validation->run();
		}
		
		/**
		 * Check the database to determine whether a requested email has already been taken.
		 */
		public function check_username_exists($email) {
			$this->load->model('user_model');

			if($this->user_model->username_exists($email)) {
				$this->form_validation->set_message('check_username_exists', 'The email '.$email.' is already in use.');
				return false;
			}
			else {
				return true;
			}
		}
		
		/**
		 * Creates and sends an email to the bar that has just signed up alerting them that
		 * we are reviewing their business reference.
		 */
		private function send_registration_email($email) {
			$subject = "bar-view.com registration";
			$message = "Thank you for registering with bar-view.com.\n\n";
			$message = $message."Go to http://www.bar-view.com and click the 'Login' link to begin personalizing your bar-view.com experience.";
			$message = $message."- The bar-view.com staff";
			
			$from = 'support@bar-view.com';
			$headers = 'From:'.$from;
			
			if(mail($email, $subject, $message, $headers))
				log_message('debug','Registration email to '.$email.' sent successfully.');
			else
				log_message('error','Registration email to '. $email.' failed.');
		}
	}
?>