<?php
	class Favorite_model extends Model {
		private $bar_id;
		private $user_id;
		
		private function Favorite_model() {
			parent::Model();
		}
		
		public function create() {
			$sql = 'insert into favorites values ('.$this->user_id.','.$this->bar_id.')';
			$this->db->query($sql);
		}
		
		public function delete() {
			$sql = 'delete from favorites where user_id = '.$this->user_id.' and bar_id = '.$this->bar_id.;
			$this->db->query($sql);
		}
		
		public function favorite_exists() {
			$sql = 'select id from favorites where user_id = '.$this->user_id.' and bar_id = '.$this->bar_id;
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