<?php
	class Barevent_model extends CI_Model {
		private $id;
		private $bar_id;
		private $detail;
		
		function Barevent_model() {
			parent::__construct();
		}
		
		public function create() {
			$clean_bar_id = $this->db->escape($this->bar_id);
			$clean_detail = $this->db->escape($this->detail);
			
			$sql = 'insert into barevents (bar_id, detail) values('.$clean_bar_id.','.$clean_detail.')';
			$this->db->query($sql);
		}
		
		public function delete() {
			$clean_bar_id = $this->db->escape($this->bar_id);
			$clean_id = $this->db->escape($this->id);
			
			$sql = 'delete from barevents where id = '.$clean_id.' and bar_id = '.$clean_bar_id;
			$this->db->query($sql);
		}
		
		public function load_event($id) {
			$clean_id = $this->db->escape($id);
		
			$sql = 'select bar_id, detail from barevents where id = '.$clean_id;
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0) {
				foreach($query->result() as $row) {
					$this->id = $id;
					$this->bar_id = $row->bar_id;
					$this->detail = $row->detail;
				}
			}
		}
		
		public function model_as_array() {
			return array('id' => $this->id, 'bar_id' => $this->bar_id, 'detail' => $this->detail);
		}
		
		public function get_id() {
			return $id;
		}
		
		public function set_id($id) {
			$this->id = $id;
		}
		
		public function get_bar_id() {
			return $bar_id;
		}
		
		public function set_bar_id($bar_id) {
			$this->bar_id = $bar_id;
		}
		
		public function get_detail() {
			return $detail;
		}
		
		public function set_detail($detail) {
			$this->detail = $detail;
		}
	}
?>