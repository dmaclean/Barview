<?php
	class Verify extends CI_Controller {
		function Verify() {
			parent::__construct();
			$this->load->library('form_validation');
			
			$this->load->helper('form');
		}
		
		function index() {
			$data = array();
			if($this->session->flashdata('error_msg')) {
				$data['error_msg'] = $this->session->flashdata('error_msg');
				log_message("debug", "flash data is ".$this->session->flashdata('error_msg'));
			}
			else if($this->session->flashdata('info_msg')) {
				$data['info_msg'] = $this->session->flashdata('info_msg');
				log_message("debug", "flash data is ".$this->session->flashdata('info_msg'));
			}

			if(!$this->session->userdata('verify_auth')) {
				$this->load->view('includes/header', $data);
				$this->load->view('verify_auth', $data);
				$this->load->view('includes/footer', $data);
			}
			else {
				$sql = 'select bar_id, name, address, city, state, zip, reference from bars where verified = 0';
				$query = $this->db->query($sql);
				
				$bars = array();
				
				foreach($query->result() as $row) {
					$b = array($row->bar_id, $row->name, $row->address.' '.$row->city.' '.$row->state, $row->reference);
					$bars[] = $b;
				}
				
				$data['bars'] = $bars;
				
				$this->load->view('includes/header', $data);
				$this->load->view('verify_view', $data);
				$this->load->view('includes/footer', $data);
			}
		}
		
		function submit() {
			if($this->input->post('password') == 'getatme') {
				$this->session->set_userdata('verify_auth', True);
			}
			else {
				$this->session->set_flashdata('error_msg', 'Incorrect password');
			}
			
			redirect('verify');
		}
		
		/**
		 * Called when the admin has accepted the registration of a bar.  This function will
		 * set the bar to verified, send an email to the bar that its registration has been
		 * approved, and drop the user back in the table view of all the un-verified bars.
		 */
		function accept() {
			$this->load->model('bar_model');
			$this->bar_model->select($this->input->post('bar_id'));
			$this->bar_model->verify();
			
			$this->send_verify_email($this->bar_model->get_email(), $this->bar_model->get_username());
			
			redirect('verify');
		}
		
		/**
		 * Creates and sends an email to the bar that has just signed up alerting them that
		 * we are reviewing their business reference.
		 */
		private function send_verify_email($email, $username) {
			$subject = "bar-view.com registration";
			$message = "Thanks again for registering with bar-view.com!\n\n";
			$message = $message."We have reviewed your business reference and successfully verified you.  ";
			$message = $message."You can now log in with your account (".$username.") and begin streaming.\n\n\n";
			$message = $message."- The bar-view.com staff";
			
			$from = 'support@bar-view.com';
			$headers = 'From:'.$from;
			
			if(mail($email, $subject, $message, $headers))
				log_message('debug','Verification email to '.$email.' sent successfully.');
			else
				log_message('error','Verification email to '. $email.' failed.');
		}
	}
?>