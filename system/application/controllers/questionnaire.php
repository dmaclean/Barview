<?php 
	/**
	 * This class is just used for receiving questionnaire answers for Facebook users.
	 */
	class Questionnaire extends CI_Controller {
		public function Questionnaire() {
			parent::__construct();
			
			$this->load->model('user_model');
		}
		
		public function submit() {
			// User Answers
			$answers = array();
			foreach($this->input->post() as $field => $fieldval) {
				$pos = strpos($field, 'q');
				
				if($pos !== false && $pos === 0) {
					$num = substr($field, 1);
					$answers[$num] = $fieldval;
				}
			}
			$this->user_model->set_user_id($this->input->post('user_id'));
			$this->user_model->set_user_answers( $answers );
			$this->user_model->insert_user_questions();
			
			redirect('/');
		}
	}
?>