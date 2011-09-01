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
				$this->load->view('includes/header');
				$this->load->view('bar_landing_view');
				$this->load->view('includes/footer');
			}
		}
	}
?>