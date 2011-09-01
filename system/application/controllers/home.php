<?php 
	class Home extends CI_Controller {
		function Home() {
			parent::__construct();
			
			$config['appId'] = '177771455596726';
			$config['secret'] = '673c8bee019e397e296d9a47b6a5e9c3';
			$config['cookie'] = true;
			
			//load Facebook php-sdk library with $config[] options
			//$this->load->library('facebook', $config); 
			
			$this->load->helper('form');
		}
	
		function index() {
			if(DEV_MODE)
				print_r( $this->session->userdata);
		
			// Send logged-in users to their personalized page.
			if($this->session->userdata('uid')) {
				// Get the user's favorites.  If they don't have any then just display all
				// bars, like we do for non-logged-in users.
				//
				// This will also apply to feeds
				$data['bars'] = $this->getFavorites($this->session->userdata('uid'));
				if(count($data['bars']) == 0) {
					$data['no_favorites'] = True;
					$data['bars'] = $this->getAllBars();
				}
				
				// Get the events for the user's favorites.  Like favorites, if they don't
				// have any favorites then just pull random ones.
				$data['events'] = $this->getEventsForFavorites($this->session->userdata('uid'));
				if(count($data['events']) == 0)
					$data['events'] = $this->getAllEvents();
				
				$this->load->view('includes/user_header', $data);
				$this->load->view('home_view', $data);
				$this->load->view('includes/footer', $data);
				
			}
			// Send non-logged-in users to a generic home page.
			else {
				$data['bars'] = $this->getAllBars();
				$data['events'] = $this->getAllEvents();
				
				$this->load->view('includes/user_header', $data);
				$this->load->view('home_view', $data);
				$this->load->view('includes/footer', $data);
			}
		}
		
		/**
		 * Get the bar_id, name, city, and state of each bar that a user has flagged as a favorite.
		 */
		private function getFavorites($uid) {
			$faves = array();
			
			$clean_uid = $this->db->escape($uid);
		
			$sql = 'select bars.bar_id as bar_id, bars.name as name, bars.city as city, bars.state as state from bars inner join favorites on bars.bar_id = favorites.bar_id where favorites.user_id = '.$clean_uid;
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$faves[] = array('bar_id' => $row->bar_id, 'name' => $row->name, 'city' => $row->city, 'state' => $row->state);
			}

			return $faves;
		}
		
		/**
		 * Retrieve the bar_id, name, city, and state for all bars.
		 *
		 * Return - an array of arrays, with each inner array containing the data.
		 */
		private function getAllBars() {
			$bars = array();
			
			$sql = 'select bar_id, name, city, state from bars';
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$bars[] = array('bar_id' => $row->bar_id, 'name' => $row->name, 'city' => $row->city, 'state' => $row->state);
			}
			
			return $bars;
		}
		
		/**
		 * Retrieve the bar name and detail for each event/deal.
		 */
		private function getAllEvents() {
			$events = array();
			
			$sql = 'select bars.name as name, detail from bars inner join barevents on bars.bar_id = barevents.bar_id';
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$events[] = array('name' => $row->name, 'detail' => $row->detail);
			}
			
			return $events;
		}
		
		/**
		 * Return all the events going on for a user's favorite bars.
		 */
		private function getEventsForFavorites($uid) {
			$events = array();
			
			$clean_uid = $this->db->escape($uid);
			
			$sql = 'select bars.name as name, detail from bars inner join favorites on bars.bar_id = favorites.bar_id inner join barevents on bars.bar_id = barevents.bar_id where favorites.user_id = '.$clean_uid;
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$events[] = array('name' => $row->name, 'detail' => $row->detail);
			}
			
			return $events;
		}
	}
?>