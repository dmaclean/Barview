<?php
	class Broadcast extends CI_Controller {
		function Broadcast() {
			parent::__construct();
			$this->load->model('barimage_model');
		}
		
		public function index() {
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if(!isset($is_logged_in) || $is_logged_in != true) {	// Can't use !== because the cookie is stored as 0/1, not true/false.
				//$data['main_content'] = 'broadcast_view';		
				$data['bar_id'] = '1234';
				$this->load->view('broadcast_view',$data);
			}
			else {
				//redirect('/home');
				
				$data['bar_id'] = $this->session->userdata('bar_id');
				
				$this->load->view('broadcast_view', $data);
			}
		}
		
		/**
		 * Leaving this method here for now, but it will not be used in
		 * favor of directly specifying the image path in the URL on views.
		 */
		public function get() {
			$bar_id = $this->uri->segment(3);
			echo $bar_id;
			
			//$this->barimage_model->set_bar_id($bar_id);
			
			header("Content-type: image/jpeg");
			//print $this->barimage_model->fetch_image_from_db();
			echo file_get_contents("/Users/dmaclean/Sites/barview/broadcast_images/".$bar_id.".jpg");
		}
		
		/**
		 * Saves an image sent in the request as POST data.  Images are stored in the
		 * broadcast_images directory.
		 */
		public function save() {
			$bar_id = $this->uri->segment(3);
			
			if(isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
				// Extract data from POST and save to filesystem.
				$jpg = $GLOBALS["HTTP_RAW_POST_DATA"];
				$filename = "/Users/dmaclean/Sites/barview/broadcast_images/".$bar_id.".jpg";
				file_put_contents($filename, $jpg);
			} else {
				echo "Encoded JPEG information not received.";
			}
		}
	}
?>