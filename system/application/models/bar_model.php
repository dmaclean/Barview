<?php
	class Bar_model extends CI_Model {
		private $bar_id;
		private $name;
		private $address;
		private $city;
		private $state;
		private $zip;
		private $lat;
		private $lng;
		
		private $username;
		private $password;
		private $email;
		
		public function Bar_model() {
			parent::__construct();
		}
		
		public function select($bar_id) {
			$sql = 'select * from bars where bar_id = '.$bar_id;
			$query = $this->db->query($sql);
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				$this->bar_id = $row->bar_id;
				$this->name = $row->name;
				$this->address = $row->address;
				$this->city = $row->city;
				$this->state = $row->state;
				$this->zip = $row->zip;
				$this->lat = $row->lat;
				$this->lng = $row->lng;
				
				$this->username = $row->username;
				$this->password = $row->password;
				$this->email = $row->email;
			}
		}
		
		public function insert() {
			#$clean_bar_id = $this->bar_id;
			$clean_name = $this->db->escape($this->name);
			$clean_address = $this->db->escape($this->address);
			$clean_city = $this->db->escape($this->city);
			$clean_state = $this->db->escape($this->state);
			$clean_zip = $this->db->escape($this->zip);
			
			$clean_username = $this->db->escape($this->username);
			$clean_password = $this->db->escape($this->password);
			$clean_email = $this->db->escape($this->email);
			
			$sql = 'insert into bars (name, address, city, state, zip, lat, lng, username, password, email) values ('
			.$clean_name.','.$clean_address.','.$clean_city.','.$clean_state.','.$clean_zip.','.
				$this->lat.','.$this->lng.','.$clean_username.','.$clean_password.','.$clean_email.')';
			$this->db->query($sql);
		}
		
		public function delete() {
			$clean_bar_id = $this->db->escape($this->bar_id);

			$sql = 'delete from bars where bar_id = '.$clean_bar_id;
			$this->db->query($sql);
		}
		
		public function update() {
			$clean_bar_id = $this->bar_id;
			$clean_name = $this->db->escape($this->name);
			$clean_address = $this->db->escape($this->address);
			$clean_city = $this->db->escape($this->city);
			$clean_state = $this->db->escape($this->state);
			$clean_zip = $this->db->escape($this->zip);
			
			$sql = 'update bars set bar_id = '.$clean_bar_id.', name = '.$clean_name.', address ='.$clean_address.', city ='.$clean_city.', state = '.$clean_state.', zip = '.$clean_zip.' where bar_id = '.$clean_bar_id;
			$this->db->query($sql);
		}
		
		public function validate() {
			$id 	= $this->db->escape($this->input->post('username'));
			$pass 	= $this->db->escape($this->input->post('password'));
		
			$sql = 'select * from bars where username = '.$id.' and password = '.$pass;
			$query = $this->db->query($sql);
			
			if($query->num_rows() == 1) {
				$row = $query->row();

				$this->bar_id = $row->bar_id;
				$this->name = $row->name;
				$this->address = $row->address;
				$this->city = $row->city;
				$this->state = $row->state;
				$this->zip = $row->zip;
				$this->lat = $row->lat;
				$this->lng = $row->lng;
				
				$this->email = $row->email;
				$this->username = $row->username;
				$this->password = $row->password;

			
				return true;
			}
			else {
				die('no rows returned');
				return false;
			}
		}
		
		/**
		 * Check to see if the proposed username is already registered.
		 *
		 * @param username 	- The username to check for.
		 * @return			- True, if the username already exists.  False, otherwise.
		 */
		public function username_exists($username) {
			$clean_username = $this->db->escape($username);
			
			$sql = 'select username from bars where username = '.$clean_username;
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0) {
				return true;
			}
			else {
				return false;
			}
		}
		
		/**
		 * A convenience function that returns a string to the user of the address in the following format.
		 *
		 * 10 Juniper Lane
		 * Medfield, MA 02052
		 */
		public function get_formatted_address() {
			return $this->address.'\n'.$this->city.', '.$this->state.' '.$this->zip;
		}
		
		/*
		 * GETTERS
		 */
		public function get_bar_id() {
			return $this->bar_id;
		}
		
		public function get_name() {
			return $this->name;
		}
		
		public function get_address() {
			return $this->address;
		}
		
		public function get_city() {
			return $this->city;
		}
		
		public function get_state() {
			return $this->state;
		}
		
		public function get_zip() {
			return $this->zip;
		}
		
		public function get_lat() {
			return $this->lat;
		}
		
		public function get_lng() {
			return $this->lng;
		}
		
		public function get_username() {
			return $this->username;
		}
		
		public function get_password() {
			return $this->password;
		}
		
		public function get_email() {
			return $this->email;
		}
		
		/*
		 * SETTERS
		 */
		public function set_bar_id($bar_id) {
			$this->bar_id = $bar_id;
		}
		
		public function set_name($name) {
			$this->name = $name;
		}
		
		public function set_address($address) {
			$this->address = $address;
		}
		
		public function set_city($city) {
			$this->city = $city;
		}
		
		public function set_state($state) {
			$this->state = $state;
		}
		
		public function set_zip($zip) {
			$this->zip = $zip;
		}
		
		public function set_lat($lat) {
			$this->lat = $lat;
		}
		
		public function set_lng($lng) {
			$this->lng = $lng;
		}
		
		public function set_username($username) {
			$this->username = $username;
		}
		
		public function set_password($password) {
			$this->password = $password;
		}
		
		public function set_email($email) {
			$this->email = $email;
		}
	}
?>