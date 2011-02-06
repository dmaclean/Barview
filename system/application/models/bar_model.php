<?php
	class Bar_model extends Model {
		private $bar_id;
		private $name;
		private $address;
		private $city;
		private $state;
		private $zip;
		
		public function Bar_model() {
			parent::Model();
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
			}
		}
		
		public function insert() {
			$clean_bar_id = $this->bar_id;
			$clean_name = $this->db->escape($this->name);
			$clean_address = $this->db->escape($this->address);
			$clean_city = $this->db->escape($this->city);
			$clean_state = $this->db->escape($this->state);
			$clean_zip = $this->db->escape($this->zip);
			
			$sql = 'insert into bars values ('.$clean_bar_id.','.$clean_name.','.$clean_address.','.$clean_city.','.$clean_state.','.$clean_zip.')';
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
	}
?>