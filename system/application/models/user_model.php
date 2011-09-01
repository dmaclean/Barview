<?php
	class User_model extends CI_Model {
		private $first_name;
		private $last_name;
		private $email;
		private $pass;
		private $dob;
		private $city;
		private $state;
		
		public function User_model() {
			parent::__construct();
		}
		
		public function validate() {
			$email 	= $this->db->escape($this->input->post('email'));
			$pass 	= $this->db->escape($this->input->post('password'));
		
			$sql = 'select * from users where email = '.$email.' and password = '.$pass;
			$query = $this->db->query($sql);
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				$this->first_name = $row->first_name;
				$this->last_name = $row->last_name;
				$this->email = $row->email;
				$this->pass = $row->password;
				$this->dob = $row->dob;
				$this->city = $row->city;
				$this->state = $row->state;
				
				return true;
			}

			return false;
		}
		
		public function create() {
			$clean_first_name = $this->db->escape($this->first_name);
			$clean_last_name = $this->db->escape($this->last_name);
			$clean_email = $this->db->escape($this->email);
			$clean_password = $this->db->escape($this->pass);
			$clean_dob = $this->db->escape($this->dob);
			$clean_city = $this->db->escape($this->city);
			$clean_state = $this->db->escape($this->state);
			
			$sql = 'insert into users values ('.$clean_first_name.','.$clean_last_name.','.$clean_email.','.$clean_password.','.$clean_dob.','.$clean_city.','.$clean_state.')';
			$this->db->query($sql);
		}
		
		public function get_favorites($uid) {
			$favorites = array();
			
			$clean_uid = $this->db->escape($uid);
		
			$sql = 'select bar_id from favorites where user_id = '.$clean_uid;
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$favorites[$row->bar_id] = $row->bar_id;
			}
			
			return $favorites;
		}
		
		/**
		 * Check to see if the proposed email is already registered.
		 *
		 * @param username 	- The email to check for.
		 * @return			- True, if the email already exists.  False, otherwise.
		 */
		public function username_exists($email) {
			$clean_email = $this->db->escape($email);
			
			$sql = 'select email from users where email = '.$clean_email;
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0) {
				return true;
			}
			else {
				return false;
			}
		}
		
		public function get_first_name() {
			return $this->first_name;
		}
		
		public function set_first_name($first_name) {
			$this->first_name = $first_name;
		}
		
		public function get_last_name() {
			return $this->last_name;
		}
		
		public function set_last_name($last_name) {
			$this->last_name = $last_name;
		}
		
		public function get_email() {
			return $this->email;
		}
		
		public function set_email($email) {
			$this->email = $email;
		}
		
		public function get_password() {
			return $this->pass;
		}
		
		public function set_password($password) {
			$this->pass = $password;
		}
		
		public function get_dob() {
			return $this->dob;
		}
		
		public function set_dob($dob) {
			$this->dob = $dob;
		}
		
		public function get_city() {
			return $this->city;
		}
		
		public function set_city($city) {
			$this->city = $city;
		}
		
		public function get_state() {
			return $this->state;
		}
		
		public function set_state($state) {
			$this->state = $state;
		}
	}
?>