<?php
	class Forgotpassword extends CI_Controller {
		private $is_bar;
	
		public function Forgotpassword() {
			parent::__construct();
			
			$this->load->library('encrypt');
			
			$this->load->helper('form');
			
			$this->is_bar = true;
		}
		
		public function index() {
			// Load up any messages, if any exist.
			if($this->session->flashdata('error_msg'))
				$data['error_msg'] = $this->session->flashdata('error_msg');
			else if($this->session->flashdata('info_msg'))
				$data['info_msg'] = $this->session->flashdata('info_msg');
			
			$data['is_bar'] = $this->is_bar;
			$data['action'] = "initial";
			
			// Get the security question and load up the forgotpassword view.
			$this->load->view('includes/header', $data);
			$this->load->view('forgotpassword_view', $data);
			$this->load->view('includes/footer', $data);
		}
		
		public function submit() {
			$data['is_bar'] = $this->is_bar;
			$data['username'] = $this->input->post('username');
		
			if($this->input->post('action') == "initial") {
				$sql = 'select sq.question as question from bars b inner join bar_account_security ba on b.bar_id = ba.bar_id inner join security_question sq on ba.security_id = sq.id where b.username = ?';
				$query = $this->db->query($sql, array($this->input->post('username')));
				
				foreach($query->result() as $row)
					$data['question'] = $row->question;
				
				// Determine whether we got a database hit for the username
				if(isset($data['question']))
					$data['action'] = "show_question";
				else {
					$data['action'] = "initial";
					$data['error_msg'] = "Invalid username.";
				}
			}
			else if($this->input->post('action') == 'show_question') {
				$sql = 'select ba.security_answer as security_answer, b.password as password from bars b inner join bar_account_security ba on b.bar_id = ba.bar_id where b.username = ?';
				$query = $this->db->query($sql, array($data['username']));
				
				foreach($query->result() as $row) {
					if($row->security_answer == $this->input->post('answer'))
						$data['password'] = $this->encrypt->decode($row->password);
				}
				
				// Determine whether we got a database hit for the username
				if(isset($data['password']))
					$data['action'] = "show_password";
				else {
					$data['action'] = "initial";
					$data['error_msg'] = "Invalid answer to the security question.";
				}
			}
			
			$this->load->view('includes/header', $data);
			$this->load->view('forgotpassword_view', $data);
			$this->load->view('includes/footer', $data);
		}
	}
?>