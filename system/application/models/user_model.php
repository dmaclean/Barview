<?php
	class User_model extends CI_Model {
		private $first_name;
		private $last_name;
		private $user_id;
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
		
		public function mobile_login() {
			$clean_username = $this->db->escape($this->user_id);
			$clean_password = $this->db->escape($this->pass);
			
			$sql = 'select * from users where email = ? and password = ?';
			$query = $this->db->query($sql, array($this->user_id, $this->pass));
			
			$xml = '<user>';
			if($query->num_rows() == 1) {
				log_message("debug", "Got a db result");
				foreach($query->result() as $row) {
					$xml = $xml.'<firstname>'.$row->first_name.'</firstname>';
					$xml = $xml.'<lastname>'.$row->last_name.'</lastname>';
					$xml = $xml.'<email>'.$row->email.'</email>';
					$xml = $xml.'<dob>'.$row->dob.'</dob>';
					$xml = $xml.'<city>'.$row->city.'</city>';
					$xml = $xml.'<state>'.$row->state.'</state>';
				}
				
				$token = $this->insert_mobile_token();
				
				$xml = $xml.'<token>'.$token.'</token>';
			}
			$xml = $xml.'</user>';
			
			return $xml;
		}
		
		public function mobile_logout($token) {
			$sql = 'delete from mobile_tokens where token = ?';
			$this->db->query($sql, array($token));
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
		
		public function update() {
			$sql = 'update users set first_name = ?, last_name = ?, dob = ?, city = ?, state = ?';
			$this->db->query($sql, array($this->first_name, $this->last_name, $this->dob, $this->city, $this->state));
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
		public function username_exists($user_id) {
			$clean_user_id = $this->db->escape($user_id);
			
			$sql = 'select email from users where email = '.$clean_user_id;
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0) {
				return true;
			}
			else {
				return false;
			}
		}
		
		/**
		 * Insert a token into the database for the mobile user.  After inserting we
		 * will return the token back to the caller (the logon function) so it can be
		 * handed back to the mobile device in an XML response.
		 *
		 * This function assumes that the user model already has the username/password set.
		 */
		private function insert_mobile_token() {
			$token = $this->generate_token();
			log_message("debug", "generate_token yielded ".$token);
			
			$sql = 'insert into mobile_tokens (token, user_id) values (?,?)';
			$this->db->query($sql, array($token, $this->user_id));
			
			return $token;
		}
		
		/**
		 * Generate a token for mobile apps logging in with a barview account.  The
		 * token generator is currently a SHA-256 hash of the the user's id concatenated
		 * with the UNIX microtime() output.
		 */
		private function generate_token() {
			$str = $this->user_id.''.microtime();
			log_message("debug","generate_token() - using string ".$str);
			return hash('sha256',$str);
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
		
		public function get_user_id() {
			return $this->user_id;
		}
		
		public function set_user_id($user_id) {
			$this->user_id = $user_id;
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