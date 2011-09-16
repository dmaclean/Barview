<?php
	class Changepassword extends CI_Controller {
		private $current_password;
	
		public function Changepassword() {
			parent::__construct();
			$this->load->library('form_validation');
			
			$this->load->helper('form');
			
			$this->is_bar = $this->session->userdata('bar_id') ? true : false;
			
			if($this->is_bar)
				$this->load->model('bar_model');
			else
				$this->load->model('user_model');
		}
		
		/**
		 * Perform changing of the user's password.
		 *
		 * Before changing the password we load in the user's current information and compare
		 * their current password in the database to what they think their current password is
		 * in the form.
		 *
		 * If those match up then we go ahead and change the password for the user.
		 */
		public function index() {
			// Load in the current user data and save off the password.
			if($this->is_bar) {
				$this->bar_model->select($this->session->userdata('bar_id'));
				$this->current_password = $this->bar_model->get_password();
			}
			else {
				$this->user_model->select($this->session->userdata('uid'));
				$this->current_password = $this->user_model->get_password();
			}
		
			// Validate the input data.  If validation fails then dump the user back onto the
			// Edit Info page.
			if($this->_submit_validation() == false) {
				log_message("debug", "Validation failed.  Redirecting back to /editinfo");
				$this->session->set_flashdata('error_msg', validation_errors());
				redirect('/editinfo');
				
				return;
			}
			log_message("debug", "Validation passed!");
			
			// If we got to here then we've passed validations.  Change the password to the 
			// whatever the user set in the form field.
			if($this->is_bar) {
				$this->bar_model->change_password($this->session->userdata('bar_id'), $this->input->post('new_password'));
				log_message("debug", "Changed password for bar ".$this->session->userdata('bar_id')." to ".$this->input->post('new_password'));
				$this->session->set_flashdata('info_msg', 'Your password has successfully been changed.');
				redirect('/barhome');
			}
			else {
				$this->user_model->change_password($this->session->userdata('uid'), $this->input->post('new_password'));
				log_message("debug", "Changed password for user ".$this->session->userdata('uid')." to ".$this->input->post('new_password'));
				$this->session->set_flashdata('info_msg', 'Your password has successfully been changed.');
				redirect('/home');
			}
		}
		
		private function _submit_validation() {
			$this->form_validation->set_rules('password', 'Current password', 'trim|required|callback_matches_current_password');
			$this->form_validation->set_rules('new_password', 'New password', 'trim|required|matches[new_password_conf]');
			$this->form_validation->set_rules('new_password_conf', 'Confirm new password', 'required');
			
			return $this->form_validation->run();
		}
		
		/**
		 * Do a simple comparison to determine whether the inputted password matches the one
		 * currently stored in the database.
		 */
		public function matches_current_password() {
			log_message("debug", "Current password is ".$this->current_password." and form field is ".$this->input->post('password'));
			if($this->input->post('password') == $this->current_password)
				return true;
			else {
				$this->form_validation->set_message('matches_current_password', 'The password entered does not match the the current password.');
				return false;
			}
				
		}
	}
?>