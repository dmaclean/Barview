<?php 
	class Home extends Controller {
		function Home() {
			parent::Controller();
			
			$config['appId'] = '177771455596726';
			$config['secret'] = '673c8bee019e397e296d9a47b6a5e9c3';
			$config['cookie'] = true;
			
			//load Facebook php-sdk library with $config[] options
			//$this->load->library('facebook', $config); 
			
			$this->load->helper('form');
		}
	
		function index() {
			// Send bars to home_bar
			if($this->session->userdata('bar_id')) {
				print_r( $this->session->userdata);
				
				$data['bar_id'] = $this->session->userdata('bar_id');
				//$this->load->view('includes/header', $data);
				$this->load->view('home_bar_view', $data);
				//$this->load->view('includes/footer', $data);
				
			}
			// Send users to home.
			else {
				print_r($this->session->userdata);
				//$this->load->view('includes/header', $data);
				$this->load->view('home_view');
				//$this->load->view('includes/footer', $data);
			}
		}
		
		private function getFavorites($uid) {
			$faves = array();
			
			$clean_uid = $this->db->escape($uid);
		
			$sql = 'select bar_id from favorites where user_id = '.$clean_uid;
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$this->load->model('bar_model');
				$this->bar_model->select($row->bar_id);
				
				// Add to a list
				$faves[] = array('id' => $this->bar_model->get_bar_id(), 'name' => $this->bar_model->get_name());//$this->bar_model;
			}

			return $faves;
		}
	}
?>