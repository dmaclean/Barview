<?php
	class Forgotpassworduser extends CI_Controller {
		private $is_bar;
	
		public function Forgotpassworduser() {
			parent::__construct();
			
			$this->load->helper('form');
			
			$this->is_bar = false;
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
			$this->load->view('includes/user_header', $data);
			$this->load->view('forgotpassword_view', $data);
			$this->load->view('includes/footer', $data);
		}
		
		public function submit() {
			$data['is_bar'] = $this->is_bar;
			$data['email'] = $this->input->post('email');
		
			if($this->input->post('action') == "initial") {
				$sql = 'select sq.question as question from users u inner join user_account_security ua on u.email = ua.email inner join security_question sq on ua.security_id = sq.id where u.email = ?';
				$query = $this->db->query($sql, array($this->input->post('email')));
				
				foreach($query->result() as $row)
					$data['question'] = $row->question;
				
				// Determine whether we got a database hit for the username
				if(isset($data['question']))
					$data['action'] = "show_question";
				else {
					$data['action'] = "initial";
					$data['error_msg'] = "Unknown email address.";
				}
			}
			else if($this->input->post('action') == 'show_question') {
				$sql = 'select ua.security_answer as security_answer, u.password as password from users u inner join user_account_security ua on u.email = ua.email where u.email = ?';
				$query = $this->db->query($sql, array($data['email']));
				
				foreach($query->result() as $row) {
					if($row->security_answer == $this->input->post('answer'))
						$data['password'] = $row->password;
				}
				
				// Determine whether we got a database hit for the username
				if(isset($data['password']))
					$data['action'] = "show_password";
				else {
					$data['action'] = "initial";
					$data['error_msg'] = "Invalid answer to the security question.";
				}
			}
			
			$this->load->view('includes/user_header', $data);
			$this->load->view('forgotpassword_view', $data);
			$this->load->view('includes/footer', $data);
		}
	}
?>