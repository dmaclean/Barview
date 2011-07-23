<?php
	class Signup extends CI_Controller {
		function Signup() {
			parent::__construct();
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
			
			$this->load->model('bar_model');
			
			$this->bar_model->set_name($this->input->post('name'));
			$this->bar_model->set_address($this->input->post('address'));
			$this->bar_model->set_city($this->input->post('city'));
			$this->bar_model->set_state($this->input->post('state'));
			$this->bar_model->set_zip($this->input->post('zip'));
			$this->bar_model->set_reference($this->input->post('reference'));
			$this->bar_model->set_verified(0);
			
			$this->bar_model->set_username($this->input->post('username'));
			$this->bar_model->set_password($this->input->post('password'));
			$this->bar_model->set_email($this->input->post('email'));
			
			$coords = $this->get_coordinates($this->bar_model);
			$this->bar_model->set_lat($coords[0]);
			$this->bar_model->set_lng($coords[1]);
			$this->bar_model->insert();
			
			// Send the user back to the logon page.
			$data['create_message'] = '';
			redirect('');
		}
		
		private function _submit_validation() {
			$this->form_validation->set_rules('name', 'Bar name', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
			$this->form_validation->set_rules('zip', 'Zip code', 'trim|required');
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password_conf]');
			$this->form_validation->set_rules('password_conf', 'Confirm password', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			#$this->form_validation->set_rules('type', 'Account Type', 'trim|required');
			
			return $this->form_validation->run();
		}
		
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
		
		public function check_username_exists($username) {
			$this->load->model('bar_model');

			if($this->bar_model->username_exists($username)) {
				$this->form_validation->set_message('check_username_exists', 'The username '.$username.' is already in use.');
				return false;
			}
			else {
				return true;
			}
		}
	}
?>