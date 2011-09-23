<?php 
	class BarHome extends CI_Controller {
		function BarHome() {
			parent::__construct();
			
			$config['appId'] = '177771455596726';
			$config['secret'] = '673c8bee019e397e296d9a47b6a5e9c3';
			$config['cookie'] = true;
			
			//load Facebook php-sdk library with $config[] options
			//$this->load->library('facebook', $config); 
			
			$this->load->helper('form');
		}
	
		function index() {
			$this->load->model('bar_model');
		
			if(DEV_MODE)
				print_r( $this->session->userdata);
			
			if($this->session->flashdata('error_msg')) {
				$data['error_msg'] = $this->session->flashdata('error_msg');
				log_message("debug", "flash data is ".$this->session->flashdata('error_msg'));
			}
			else if($this->session->flashdata('info_msg')) {
				$data['info_msg'] = $this->session->flashdata('info_msg');
				log_message("debug", "flash data is ".$this->session->flashdata('info_msg'));
			}
		
			// Bar is already logged in.  Send them to their personalized homepage.
			if($this->session->userdata('bar_id')) {
			
				$data['events'] = $this->bar_model->get_events($this->session->userdata('bar_id'));
				
				$data['bar_id'] = $this->session->userdata('bar_id');
				$data['bar_name'] = $this->session->userdata('bar_name');
				$data['session_id'] = $this->session->userdata('session_id');
				$this->load->view('includes/header', $data);
				$this->load->view('home_bar_view', $data);
				$this->load->view('includes/footer', $data);
				
			}
			// Not logged in.  Send to generic bar landing page.
			else {
				// add a garbage value in here just so we have $data available to us.
				// If we've just arrived on the page then nothing would have been put
				// in $data otherwise.
				$data['placeholder'] = null;
				
				$this->load->view('includes/header', $data);
				$this->load->view('bar_landing_view', $data);
				$this->load->view('includes/footer', $data);
			}
		}
	}
?>