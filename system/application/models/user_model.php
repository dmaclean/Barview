<?php
	class User_model extends CI_Model {
		private $first_name;
		private $last_name;
		private $user_id;
		private $pass;
		private $dob;
		private $city;
		private $state;
		private $security_id;
		private $security_answer;
		
		public function User_model() {
			parent::__construct();
		}
		
		public function select($user_id) {
			$sql = 'select 	u.first_name as first_name, u.last_name as last_name, u.password as password, u.dob as dob, u.city as city, u.state as state, ua.security_id as security_id, ua.security_answer as security_answer from users u inner join user_account_security ua on u.email = ua.email where u.email = ?';
			$query = $this->db->query($sql, array($user_id));
			
			foreach($query->result() as $row) {
				$this->first_name = $row->first_name;
				$this->last_name = $row->last_name;
				$this->user_id = $user_id;
				$this->pass = $row->password;
				$this->dob = $row->dob;
				$this->city = $row->city;
				$this->state = $row->state;
				
				$this->security_id = $row->security_id;
				$this->security_answer = $row->security_answer;
			}
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
			$clean_email = $this->db->escape($this->user_id);
			$clean_password = $this->db->escape($this->pass);
			$clean_dob = $this->db->escape($this->dob);
			$clean_city = $this->db->escape($this->city);
			$clean_state = $this->db->escape($this->state);
			
			$sql = 'insert into users values ('.$clean_first_name.','.$clean_last_name.','.$clean_email.','.$clean_password.','.$clean_dob.','.$clean_city.','.$clean_state.')';
			$this->db->query($sql);
		}
		
		/**
		 * Insert the user account security information (security question and answer).
		 *
		 * This call will occur when a user signs up in usersignup.php.
		 */
		public function insert_security() {
			$sql = 'insert into user_account_security (email, security_id, security_answer) values (?, ?, ?)';
			$this->db->query($sql, array($this->user_id, $this->security_id, $this->security_answer));
		}
		
		/**
		 * Update the user's basic information with the data currently set in the bar model.
		 */
		public function update() {
			$sql = 'update users set first_name = ?, last_name = ?, dob = ?, city = ?, state = ?';
			$this->db->query($sql, array($this->first_name, $this->last_name, $this->dob, $this->city, $this->state));
		}
		
		/**
		 * Update the account security information (security question and answer) for a user.
		 *
		 * This call occurs inside editinfo.php.
		 */
		public function update_security() {
			$sql = 'update user_account_security set security_id = ?, security_answer = ? where email = ?';
			$this->db->query($sql, array($this->security_id, $this->security_answer, $this->user_id));
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
		 * Change the password for the user specified by user_id.
		 *
		 * It is assumed that all necessary validations have already been
		 * performed prior to executing this function.
		 */
		public function change_password($user_id, $new_password) {
			$sql = 'update users set password = ? where email = ?';
			$this->db->query($sql, array($new_password, $user_id));
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
		
		public function get_security_id() {
			return $this->security_id;
		}
		
		public function set_security_id($id) {
			$this->security_id = $id;
		}
		
		public function get_security_answer() {
			return $this->security_answer;
		}
		
		public function set_security_answer($answer) {
			$this->security_answer = $answer;
		}
	}	
?>