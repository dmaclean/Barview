<?php 
	class Barimage_model extends CI_Model {
		private $bar_id;
		private $image;
		
		public function Barimage_model() {
			parent::__construct();
		}
		
		public function fetch_image_from_db() {
			$sql = 'select image from bar_images where bar_id = '.$this->bar_id;
			$query = $this->db->query($sql);
			
			if($query->num_rows() == 1) {
				$row = $query->row();
				return $row->image;
			}
			
			return null;
		}
		
		public function fetch_image_from_filesystem() {
			return file_get_contents("broadcast_images/".$this->bar_id.".jpg");
		}
		
		public function insert_image() {
			$sql = 'insert into bar_images values ('.$this->bar_id.',"'.$this->image.'", current_timestamp)';
			$this->db->query($sql);
		}
		
		public function update_image() {
			if($this->image_exists($this->bar_id)) {
				$sql = 'update bar_images set image = '.$this->image.', last_updated = current_timestamp where bar_id = '.$this->bar_id;
				$this->db->query($sql);
			}
			else {
				$this->insert_image();
			}
		}
		
		private function image_exists($bar_id) {
			$sql = 'select last_updated from bar_images where bar_id = '.$bar_id;
			$query = $this->db->query($sql);
			
			if($query->num_rows() == 1) {
				return true;
			}
			
			return false;
		}
		
		public function get_image() {
			return $this->image;
		}
		
		public function set_image($image) {
			$this->image = $image;
		}
		
		public function get_bar_id() {
			return $this->bar_id;
		}
		
		public function set_bar_id($bar_id) {
			$this->bar_id = $bar_id;
		}
	}
?>