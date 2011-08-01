<?php
	class Search extends CI_Controller {
		function Search() {
			parent::__construct();
			
			$this->load->helper('form');
		}
		
		function index() {
			
		}
		
		function submit() {
			$clean_param = $this->db->escape('%'.$this->input->post('search').'%');
			
			$sql = 'select bar_id, name, address, city, state from bars where name like '.$clean_param;
			$query = $this->db->query($sql);
			
			$results = array();
			foreach($query->result() as $row) {
				$curr = array($row->bar_id, $row->name, $row->address.' '.$row->city.' '.$row->state);
				$results[] = $curr;
			}
			
			$data['search_results'] = $results;
			
			$this->load->view('search_results_view', $data);
		}
	}
?>