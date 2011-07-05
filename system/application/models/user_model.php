<?php
	class User_model extends CI_Model {
		private $username;
		private $pass;
		private $name;
		private $email;
		private $type;
		
		public function User_model() {
			parent::__construct();
		}
		
		public function validate() {
			$id 	= $this->db->escape($this->input->post('username'));
			$pass 	= $this->db->escape($this->input->post('password'));
		
			$sql = 'select * from users where id = '.$id.' and pass = '.$pass;
			$query = $this->db->query($sql);
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				$this->username = $row->id;
				$this->pass = $row->pass;
				$this->name = $row->name;
				$this->email = $row->email;
				$this->type = $row->type;
			
				return true;
			}
			else {
				die('no rows returned');
				return false;
			}
		}
		
		public function create() {
			$clean_username = $this->db->escape($this->username);
			$clean_password = $this->db->escape($this->pass);
			$clean_name = $this->db->escape($this->name);
			$clean_email = $this->db->escape($this->email);
			$clean_type = $this->db->escape($this->type);
			
			$sql = 'insert into users values ('.$clean_username.','.$clean_password.','.$clean_type.','.$clean_name.', current_timestamp, current_timestamp,'.$clean_email.', 0)';
			$this->db->query($sql);
		}
		
		/**
		 * Check to see if the proposed username is already registered.
		 *
		 * @param username 	- The username to check for.
		 * @return			- True, if the username already exists.  False, otherwise.
		 */
		public function username_exists($username) {
			$clean_username = $this->db->escape($username);
			
			$sql = 'select id from users where id = '.$clean_username;
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0) {
				return true;
			}
			else {
				return false;
			}
		}
		
		public function get_bar_id() {
			if($this->type == 'user')
				return -1;
			
			$clean_username = $this->db->escape($this->username);
			
			$sql = 'select bar_id from bars_users where user_id = '.$clean_username;
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0) {
				$row = $query->row();
				return $row->bar_id;
			}
		}
		
		public function set_username($username) {
			$this->username = $username;
		}
		
		public function set_password($password) {
			$this->pass = $password;
		}
		
		public function set_realname($name) {
			$this->name = $name;
		}
		
		public function set_email($email) {
			$this->email = $email;
		}
		
		public function set_type($type) {
			$this->type = $type;
		}
		
		public function get_type() {
			return $this->type;
		}
	}
?>