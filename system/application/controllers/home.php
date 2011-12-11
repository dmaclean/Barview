<?php 
	
	require 'facebook-php-sdk/src/facebook.php';

	class Home extends CI_Controller {
		function Home() {
			parent::__construct();
			
			$this->config->load('facebook');
			
			$config['appId'] = $this->config->item('facebook_app_id');
			$config['secret'] = $this->config->item('facebook_api_secret');
			$config['cookie'] = true;
			
			$this->load->library('barviewusermanager', array('session' => $this->session));

			$this->load->helper('form');
			
			$this->load->model('user_model');
		}
	
		function index() {
			$this->barviewusermanager->processSession();
		
			if(DEV_MODE)
				print_r( $this->session->userdata);
				
			/*
			 * Check if we're dealing with a bar.  If so, redirect them to /barhome
			 */
			if($this->barviewusermanager->isBar()) {
				$this->session->set_flashdata("info_msg", "If you would like to view the main Barview page, log out first, then click the 'Users' link.");
				redirect('barhome');
			}
			
			/*
			 * Not a bar, keep going...
			 */
			
			// Make the facebook object available
			$data['facebook'] = $this->barviewusermanager->getFacebookObject();
			
			if($this->session->flashdata('error_msg')) {
				$data['error_msg'] = $this->session->flashdata('error_msg');
				log_message("debug", "flash data is ".$this->session->flashdata('error_msg'));
			}
			else if($this->session->flashdata('info_msg')) {
				$data['info_msg'] = $this->session->flashdata('info_msg');
				log_message("debug", "flash data is ".$this->session->flashdata('info_msg'));
			}
		
			// Send logged-in users to their personalized page.
			if($this->session->userdata('uid')) {
				if($this->session->userdata('usertype') == BARVIEW_TYPE)
					$this->user_model->select($this->session->userdata('uid'));
				else {
					$this->user_model->set_user_id($this->session->userdata('uid'));
					$this->user_model->query_user_answers();
					
					$data['show_questionnaire'] = $this->session->userdata('uid') && $this->session->userdata('usertype') == FACEBOOK_TYPE && count($this->user_model->get_user_answers()) == 0;
				}
			
				// Get the user's favorites.  If they don't have any then just display all
				// bars, like we do for non-logged-in users.
				//
				// This will also apply to feeds
				$data['bars'] = $this->getFavorites($this->session->userdata('uid'));
				if(count($data['bars']) == 0) {
					$data['no_favorites'] = True;
					$data['bars'] = $this->getAllBars();
				}
				else {
					$data['nonfaves'] = $this->getNonFavorites($this->session->userdata('uid'), 5-count($data['bars']));
				}
				
				// Get the events for the user's favorites.  Like favorites, if they don't
				// have any favorites then just pull random ones.
				$data['events'] = $this->getEventsForFavorites($this->session->userdata('uid'));
				if(count($data['events']) == 0)
					$data['events'] = $this->getAllEvents();
				else if(count($data['events']) < 5) {
					$data['nonfave_events'] = $this->getEventsForNonFavorites($this->session->userdata('uid'), 5-count($data['events']));
				}
				
				// Grab questionnaire questions...
				$data['user_questions'] = $this->get_user_questions();
				
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
		
		/*
		 * Get the bar_id, name, city, and state of $num number of bars that are NOT flagged as a user's favorite.
		 */
		private function getNonFavorites($uid, $num) {
			$nonfaves = array();
			
			// Just boot out if the user has at least 5 favorites to display.
			if($num <= 0)
				return $nonfaves;
			
			$sql = 'select bar_id, name, city, state from bars where bar_id not in (select bars.bar_id from bars inner join favorites on bars.bar_id = favorites.bar_id where favorites.user_id = ?) order by rand() limit ?';
			$query = $this->db->query($sql, array($uid, $num));
			
			foreach($query->result() as $row) {
				$nonfaves[] = array('bar_id' => $row->bar_id, 'name' => $row->name, 'city' => $row->city, 'state' => $row->state);
			}

			return $nonfaves;
		}
		
		/**
		 * Retrieve the bar_id, name, city, and state for all bars that have been verified.
		 *
		 * Return - an array of arrays, with each inner array containing the data.
		 */
		private function getAllBars() {
			$bars = array();
			
			$sql = 'select bar_id, name, city, state from bars where verified = 1';
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$bars[] = array('bar_id' => $row->bar_id, 'name' => $row->name, 'city' => $row->city, 'state' => $row->state);
			}
			
			return $bars;
		}
		
		/**
		 * Retrieve the bar name and detail for each event/deal for bars that have been verified.
		 */
		private function getAllEvents() {
			$events = array();
			
			$sql = 'select bars.name as name, detail from bars inner join barevents on bars.bar_id = barevents.bar_id and bars.verified = 1';
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				// We already have this bar
				if(isset($events[$row->name])) 
					$events[$row->name][] = $row->detail;
				else {
					$arr = array($row->detail);
					$events[$row->name] = $arr;
				}
			}
			
			return $events;
		}
		
		/**
		 * Return all the events going on for a user's favorite bars.
		 */
		private function getEventsForFavorites($uid) {
			$events = array();
			
			$sql = 'select bars.name as name, detail from bars inner join favorites on bars.bar_id = favorites.bar_id inner join barevents on bars.bar_id = barevents.bar_id where favorites.user_id = ?';
			$query = $this->db->query($sql, array($uid));
			
			foreach($query->result() as $row) {
				// We already have this bar
				if(isset($events[$row->name])) 
					$events[$row->name][] = $row->detail;
				else {
					$arr = array($row->detail);
					$events[$row->name] = $arr;
				}
			}
			
			return $events;
		}
		
		/**
		 * Retrieves events from bars that are not part of the user's favorites.  The results are
		 * random, based on the order by clause.  The $num value dictates how many results to get.
		 */
		private function getEventsForNonFavorites($uid, $num) {
			$events = array();
			
			// Boot out if the user is already displaying events from 5 or more bars.
			if($num <= 0)
				return $events;
				
			$sql = 'select b.name as name, be.detail as detail from barevents be inner join bars b on be.bar_id = b.bar_id where b.bar_id not in (select bars.bar_id from bars inner join favorites on bars.bar_id = favorites.bar_id where favorites.user_id = ?) order by rand() limit ?';
			$query = $this->db->query($sql, array($uid, $num));
			
			foreach($query->result() as $row) {
				// We already have this bar
				if(isset($events[$row->name])) 
					$events[$row->name][] = $row->detail;
				else {
					$arr = array($row->detail);
					$events[$row->name] = $arr;
				}
			}
			
			return $events;
		}
		
		/*
		 * Fetch all the user questionnaire questions and their associated options.  This will
		 * return an array of arrays.
		 */
		private function get_user_questions() {
			$sql = 'select q.id as qid, q.question as question, o.id as oid, o.q_id as oqid, o.answer as answer from user_questionnaire_questions q inner join user_questionnaire_options o on q.id = o.q_id';
			$query = $this->db->query($sql);
			
			$results = array();
			foreach($query->result() as $row) {
				// We haven't seen this question yet, so create a new array for its options
				if(!isset($results[$row->qid]))
					$results[$row->qid] = array('question' => $row->question, 'options' => array('' => 'Select one', $row->oid => $row->answer));
				// We've already seen this question, so just append the option to the end of its array.
				else
					$results[$row->qid]['options'][$row->oid] = $row->answer;
			}
			
			return $results;
		}
	}
?>