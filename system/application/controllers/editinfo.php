<?php

	require 'system/application/controllers/bvbase.php';

	class Editinfo extends CI_Controller {
		private $is_bar;
	
		function Editinfo() {
			parent::__construct();
			$this->load->library('form_validation');
			
			$this->load->helper('form');
			$this->load->helper('statelist');
			
			$this->is_bar = $this->session->userdata('bar_id') ? true : false;
			
			if($this->is_bar)
				$this->load->model('bar_model');
			else
				$this->load->model('user_model');
				
				
			$this->config->load('facebook');
			
			$config['appId'] = $this->config->item('facebook_app_id');
			$config['secret'] = $this->config->item('facebook_api_secret');
			$config['cookie'] = true;
			
			$this->load->library('barviewusermanager', array('session' => $this->session));
			
			$this->barviewusermanager->processSession();
		}
		
		function index() {
			$data['facebook'] = $this->barviewusermanager->getFacebookObject();
		
			// Is the request from a logged in barview user?  If not, back to the homepage because
			// they are URL hacking.
			if(!$this->is_barview_user() && !$this->session->userdata('bar_id'))
				redirect("/");
			
			$data['no_hero'] = true;
			$data['security_questions'] = $this->get_security_questions();
		
			// Determine whether we are a user or bar and pull the appropriate information
			// from the database so we can pre-populate the form fields.
			$data['is_bar'] = $this->is_bar;
			if($this->is_bar) {
				$this->bar_model->select($this->session->userdata('bar_id'));
				$data['bar_model'] = $this->bar_model;
			}
			else {
				$this->user_model->select($this->session->userdata('uid'));
				$data['user_model'] = $this->user_model;
				log_message("debug", "Saved user_model to data (".$data['user_model']->get_first_name().")");
			}
			
			if($this->session->flashdata('error_msg')) {
				$data['error_msg'] = $this->session->flashdata('error_msg');
				log_message("debug", "flash data is ".$this->session->flashdata('error_msg'));
			}
			else if($this->session->flashdata('info_msg')) {
				$data['info_msg'] = $this->session->flashdata('info_msg');
				log_message("debug", "flash data is ".$this->session->flashdata('info_msg'));
			}
			
			// Show the form for updating info.
			if($this->is_bar)
				$this->load->view('includes/header', $data);
			else
				$this->load->view('includes/user_header', $data);
			$this->load->view('editinfo_view', $data);
			$this->load->view('includes/footer', $data);
		}
		
		function submit() {
			// Perform input validation.
			if($this->_submit_validation() == false) {
				$this->index();
				return;
			}
			
			if($this->is_bar) {
				$this->process_bar();
				redirect('barhome');
			}
			else {
				$this->process_user();
				redirect('');
			}
		}
		
		private function _submit_validation() {
			// Validation for Barview users
			if(!$this->is_bar) {
				$this->form_validation->set_rules('first_name', 'First name', 'trim|required|alpha');
				$this->form_validation->set_rules('last_name', 'Last name', 'trim|required|alpha');
				$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|alpha_dash|callback_valid_date');
				$this->form_validation->set_rules('city', 'City', 'trim|required');
				$this->form_validation->set_rules('state', 'State', 'trim|required|alpha');
			}
			// Validation for bars.
			else {
				$this->form_validation->set_rules('name', 'Bar name', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('city', 'City', 'trim|required');
				$this->form_validation->set_rules('state', 'State', 'trim|required|alpha');
				$this->form_validation->set_rules('zip', 'Zip code', 'trim|required|numeric|exact_length[5]');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			}
			
			return $this->form_validation->run();
		}
		
		private function process_user() {
			$this->load->model('user_model');
			
			$this->user_model->set_first_name($this->input->post('first_name'));
			$this->user_model->set_last_name($this->input->post('last_name'));
			$this->user_model->set_user_id($this->input->post('email'));
			//$this->user_model->set_password($this->input->post('password'));
			$this->user_model->set_dob($this->input->post('dob'));
			$this->user_model->set_city($this->input->post('city'));
			$this->user_model->set_state($this->input->post('state'));
			$this->user_model->set_security_id($this->input->post('security_question'));
			$this->user_model->set_security_answer($this->input->post('security_answer'));
			
			// Update the user info as well as the account security info.
			$this->user_model->update();
			$this->user_model->update_security();
		}
		
		private function process_bar() {
			$this->load->model('bar_model');
			
			$this->bar_model->set_bar_id($this->session->userdata('bar_id'));
			$this->bar_model->set_name($this->input->post('name'));
			$this->bar_model->set_address($this->input->post('address'));
			$this->bar_model->set_city($this->input->post('city'));
			$this->bar_model->set_state($this->input->post('state'));
			$this->bar_model->set_zip($this->input->post('zip'));
			
			$this->bar_model->set_email($this->input->post('email'));
			$this->bar_model->set_security_id($this->input->post('security_question'));
			$this->bar_model->set_security_answer($this->input->post('security_answer'));
			
			$coords = $this->get_coordinates($this->bar_model);
			$this->bar_model->set_lat($coords[0]);
			$this->bar_model->set_lng($coords[1]);
			
			// Update the bar info as well as its account security info.
			$this->bar_model->update();
			$this->bar_model->update_security();
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
		 * Check that the date follows the format yyyy/mm/dd.
		 */
		public function valid_date($date) {
			if(!preg_match("/^\d{4}-\d{2}-\d{2}$/",$date)) {
				$this->form_validation->set_message('valid_date', 'The date '.$date.' is invalid.  Please use the format yyyy/mm/dd');
				return false;
			}
			
			return true;
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
		
		/**
		 * Performs geocoding of an address (address --> latitude/longitude) with the Google API
		 * so we can have coordinates to put on a map for the mobile apps.
		 */
		private function get_coordinates($bar) {
			$reverseCodingUrl = 'http://maps.googleapis.com/maps/api/geocode/xml?address='.
					str_replace(" ", "+", $bar->get_address()).','.
					str_replace(" ", "+", $bar->get_city()).','.
					$bar->get_state().'&sensor=false';
			
			$coords = array(0.0, 0.0);
			
			$coord_xml = file_get_contents($reverseCodingUrl);
			
			if (preg_match("/<location>\s*<lat>([-0-9\\.]*)<\/lat>\s*<lng>([-0-9\\.]*)<\/lng>\s*<\/location>/i", 
						$coord_xml, $matches)) {
				
				$coords[0] = $matches[1];
				$coords[1] = $matches[2];
			}
			
			return $coords;
		}
		
		private function get_security_questions() {
			$sql = 'select * from security_question';
			$query = $this->db->query($sql);
			
			$results = array();
			foreach($query->result() as $row)
				$results[$row->id] = $row->question;
			
			return $results;
		}
		
		/**
		 * Determine whether the user is a validated Bar-view user.
		 */
		private function is_barview_user() {
			return $this->session->userdata('usertype') && $this->session->userdata('usertype') == BARVIEW_TYPE;
		}
	}
?>