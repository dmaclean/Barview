<?php
	class Verify extends CI_Controller {
		function Verify() {
			parent::__construct();
			$this->load->library('form_validation');
			
			$this->load->helper('form');
		}
		
		function index() {
			$sql = 'select bar_id, name, address, city, state, zip, reference from bars where verified = 0';
			$query = $this->db->query($sql);
			
			$bars = array();
			
			foreach($query->result() as $row) {
				$b = array($row->bar_id, $row->name, $row->address.' '.$row->city.' '.$row->state, $row->reference);
				$bars[] = $b;
			}
			
			$data['bars'] = $bars;
			
			$this->load->view('includes/header', $data);
			$this->load->view('verify_view', $data);
			$this->load->view('includes/footer', $data);
		}
		
		/**
		 * Called when the admin has accepted the registration of a bar.  This function will
		 * set the bar to verified, send an email to the bar that its registration has been
		 * approved, and drop the user back in the table view of all the un-verified bars.
		 */
		function accept() {
			$this->load->model('bar_model');
			$this->bar_model->select($this->input->post('bar_id'));
			$this->bar_model->verify();
			
			redirect('verify');
		}
	}
?>