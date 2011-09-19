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
		private $reference;
		private $verified;
		private $security_id;
		private $security_answer;
		
		private $username;
		private $password;
		private $email;
		
		public function Bar_model() {
			parent::__construct();
			
			$this->load->library('encrypt');
		}
		
		public function select($bar_id) {
			$sql = 'select 	b.bar_id as bar_id, b.name as name, b.address as address, b.city as city, b.state as state, b.zip as zip, b.lat as lat, b.lng as lng, b.reference as reference, b.verified as verified, b.username as username, b.password as password, b.email as email, bas.security_id as security_id, bas.security_answer as security_answer from bars b inner join bar_account_security bas on b.bar_id = bas.bar_id where b.bar_id = ?';
			$query = $this->db->query($sql, array($bar_id));
			
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
				$this->reference = $row->reference;
				$this->verified = $row->verified;
				
				$this->security_id = $row->security_id;
				$this->security_answer = $row->security_answer;
				
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
			$clean_reference = $this->db->escape($this->reference);
			$clean_verified = $this->db->escape($this->verified);
			
			$clean_username = $this->db->escape($this->username);
			$clean_password = $this->db->escape($this->password);
			$clean_email = $this->db->escape($this->email);
			
			$sql = 'insert into bars (name, address, city, state, zip, lat, lng, reference, verified, username, password, email) values ('
			.$clean_name.','.$clean_address.','.$clean_city.','.$clean_state.','.$clean_zip.','.
				$this->lat.','.$this->lng.','.$clean_reference.','.$clean_verified.','.$clean_username.','.$clean_password.','.$clean_email.')';
			$this->db->query($sql);
			
			$this->bar_id = $this->db->insert_id();
		}
		
		public function insert_security() {
			$sql = 'insert into bar_account_security (bar_id, security_id, security_answer) values(?, ?, ?)';
			$this->db->query($sql, array($this->bar_id, $this->security_id, $this->security_answer));
		}
		
		/**
		 * Delete the bar from the database.
		 */
		public function delete() {
			$clean_bar_id = $this->db->escape($this->bar_id);

			$sql = 'delete from bars where bar_id = '.$clean_bar_id;
			$this->db->query($sql);
		}
		
		/**
		 * Update a bar.  For updates the verified, bar_id, password, and reference columns are excluded.
		 */
		public function update() {
			$sql = 'update bars set name = ?, address = ?, city = ?, state = ?, zip = ?, lat = ?, lng = ?, email = ? where bar_id = ?';
			$this->db->query($sql, array($this->name, $this->address, $this->city, $this->state, $this->zip, $this->lat, $this->lng, $this->email, $this->bar_id));
		}
		
		public function update_security() {
			$sql = 'update bar_account_security set security_id = ?, security_answer = ? where bar_id = ?';
			$this->db->query($sql, array($this->security_id, $this->security_answer, $this->bar_id));
		}
		
		/**
		 * Flag the bar as verified
		 */
		public function verify() {
			$sql = 'update bars set verified = 1 where bar_id = '.$this->bar_id;
			
			$query = $this->db->query($sql);
		}
		
		public function validate() {
			//$id 	= $this->db->escape($this->input->post('username'));
			//$pass 	= $this->encrypt->encode($this->db->escape($this->input->post('password')));
		
			$sql = 'select * from bars where username = ? and verified = 1';
			$query = $this->db->query($sql, array($this->input->post('username')));
			
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
				$this->reference = $row->reference;
				$this->verified = $row->verified;
				
				$this->email = $row->email;
				$this->username = $row->username;
				$this->password = $row->password;

				if($this->encrypt->decode($this->password) == $this->input->post('password'))
					return true;
			}
			else {
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
		 * Change the password for the bar specified by bar_id.
		 *
		 * It is assumed that all necessary validations have already been
		 * performed prior to executing this function.
		 */
		public function change_password($bar_id, $new_password) {
			$sql = 'update bars set password = ? where bar_id = ?';
			$this->db->query($sql, array($new_password, $bar_id));
		}
		
		public function get_events($bar_id) {
			$events = array();
		
			$clean_id = $this->db->escape($bar_id);
			
			$sql = 'select id, bar_id, detail from barevents where bar_id = '.$clean_id;
			$query = $this->db->query($sql);
			
			foreach($query->result() as $row) {
				$events[] = array('id' => $row->id, 'bar_id' => $row->bar_id, 'detail' => $row->detail);
			}
			
			return $events;
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
		
		/**
		 * Fetch the text of the security question from the security_question table based on
		 * the security_id in the user profile.
		 */
		public function get_security_question() {
			$sql = 'select question from security_question where id = ?';
			$query = $this->db->query($sql, $this->security_id);
			
			$question = '';
			foreach($query->result() as $row) {
				$question = $row->question;
			}
			
			return $question;
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
		
		public function get_reference() {
			return $this->reference;
		}
		
		public function get_verified() {
			return $this->verified;
		}
		
		public function get_security_id() {
			return $this->security_id;
		}
		
		public function get_security_answer() {
			return $this->security_answer;
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
		
		public function set_reference($reference) {
			$this->reference = $reference;
		}
		
		public function set_verified($verified) {
			$this->verified = $verified;
		}
		
		public function set_security_id($id) {
			$this->security_id = $id;
		}
		
		public function set_security_answer($answer) {
			$this->security_answer = $answer;
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