<?php
	class Verify extends CI_Controller {
		function Verify() {
			parent::__construct();
			$this->load->library('form_validation');
			
			$this->load->helper('form');
		}
		
		function index() {
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