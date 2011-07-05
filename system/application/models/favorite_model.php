<?php
	class Favorite_model extends CI_Model {
		private $bar_id;
		private $user_id;
		
		function Favorite_model() {
			parent::__construct();
		}
		
		public function create() {
			$data = array('user_id' => $this->user_id, 'bar_id' => $this->bar_id);
			$sql = $this->db->insert_string('favorites', $data);
			$this->db->query($sql);
		}
		
		public function delete() {
			$sql = 'delete from favorites where user_id = '.$this->db->escape($this->user_id).
					' and bar_id = '.$this->db->escape($this->bar_id);
			$this->db->query($sql);
		}
		
		public function favorite_exists() {
			$sql = 'select id from favorites where user_id = '.$this->db->escape($this->user_id).
					' and bar_id = '.$this->db->escape($this->bar_id);
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0) {
				return true;
			}
			else {
				return false;
			}
		}
		
		public function set_user_id($user_id) {
			$this->user_id = $user_id;
		}
		
		public function set_bar_id($bar_id) {
			$this->bar_id = $bar_id;
		}
	}
?>