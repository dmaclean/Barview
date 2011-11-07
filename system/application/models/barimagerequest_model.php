<?php
	class Barimagerequest_Model extends CI_Model {
		private $bar_id;
		private $user_id;
		private $timestamp;
		
		public function Barimagerequest_Model() {
			parent::__construct();
		}
		
		public function create() {
			$sql = "insert into bar_image_requests values(?, ?, now())";
			$this->db->query($sql, array($this->user_id, $this->bar_id));
		}
		
		public function delete() {
			$sql = "delete from bar_image_requests where bar_id = ? and user_id = ? and timestamp = ?";
			$this->db->query($sql, array($this->bar_id, $this->user_id, $this->timestamp));
		}
		
		public function get_bar_id() {
			return $this->bar_id;
		}
		public function set_bar_id($bar_id) {
			$this->bar_id = $bar_id;
		}
		
		public function get_user_id() {
			return $this->user_id;
		}
		public function set_user_id($user_id) {
			$this->user_id = $user_id;
		}
		
		public function get_timestamp() {
			return $this->timestamp;
		}
		public function set_timestamp($timestamp) {
			$this->timestamp = $timestamp;
		}
	}
?>