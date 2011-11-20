<?php
	class Search extends CI_Controller {
		function Search() {
			parent::__construct();
			
			$this->load->helper('form');
			
			$this->config->load('facebook');
			
			$config['appId'] = $this->config->item('facebook_app_id');
			$config['secret'] = $this->config->item('facebook_api_secret');
			$config['cookie'] = true;
			
			$this->load->library('barviewusermanager', array('session' => $this->session));
			
			$this->barviewusermanager->processSession();
		}
		
		function index() {
			
		}
		
		function submit() {
			$data['facebook'] = $this->barviewusermanager->getFacebookObject();
		
			$this->load->model('user_model');
		
			$clean_param = $this->db->escape('%'.$this->input->post('search').'%');

			$sql = 'select bar_id, name, address, city, state from bars where name like '.$clean_param;
			$query = $this->db->query($sql);
			
			$results = array();
			foreach($query->result() as $row) {
				$curr = array($row->bar_id, $row->name, $row->address.' '.$row->city.' '.$row->state);
				$results[] = $curr;
			}
			
			$data['no_hero'] = true;
			$data['search_results'] = $results;
			
			if(count($results) > 0 && $this->session->userdata('is_logged_in')) {
				$data['favorites'] = $this->user_model->get_favorites($this->session->userdata('uid'));
			}
			
			$this->load->view('includes/user_header', $data);
			$this->load->view('search_results_view', $data);
			$this->load->view('includes/footer', $data);
		}
	}
?>