<?php
	class Bardetail extends CI_Controller {
		function Bardetail() {
			parent::__construct();
			
			$this->load->model('bar_model');
			$this->load->model('user_model');
			
			$this->config->load('facebook');
			
			$this->load->helper('form');
			
			$config['appId'] = $this->config->item('facebook_app_id');
			$config['secret'] = $this->config->item('facebook_api_secret');
			$config['cookie'] = true;
			
			$this->load->library('barviewusermanager', array('session' => $this->session));
			
			$this->barviewusermanager->processSession();
		}
		
		function index() {
			$data['facebook'] = $this->barviewusermanager->getFacebookObject();
			
			// No URL hacking!  If the user isn't logged in then send them to the home page.
			if(!$this->session->userdata('uid')) {
				redirect('/');
			}

			$bar_id = $this->uri->segment(3);
			
			$this->bar_model->select($bar_id);
			$events = $this->bar_model->get_events($bar_id);
			
			$data['events'] = $events;
			$data['bar_id'] = $bar_id;
			$data['bar_name'] = $this->bar_model->get_name();
			$data['bar_address'] = $this->bar_model->get_address();
			$data['bar_city'] = $this->bar_model->get_city();
			$data['bar_state'] = $this->bar_model->get_state();
			$data['bar_zip'] = $this->bar_model->get_zip();
			$data['formatted_addr'] = $this->bar_model->get_formatted_address();
			
			$data['no_hero'] = true;
			
			if($this->session->userdata('is_logged_in')) {
				$data['favorites'] = $this->user_model->get_favorites($this->session->userdata('uid'));
			}
			
			$this->load->view('includes/user_header', $data);
			$this->load->view('bardetail_view', $data);
			$this->load->view('includes/footer', $data);
		}
	}
?>