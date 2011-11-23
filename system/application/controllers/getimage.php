<?php
	/**
	 * This controller provides us with a way to serve up images while also being
	 * able to record usage data with the header content that come in with requests.
	 */
	class Getimage extends CI_Controller {
		public function Getimage() {
			parent::__construct();
			
			
		}
		
		public function index() {
			$bar_id = $this->uri->segment(3);
			
			$user_id = NULL;
			$type = NULL;
		
			// Extract relevant headers - user_id and type
			if(isset($_SERVER['HTTP_USER_ID']))
				$user_id = $_SERVER['HTTP_USER_ID'];
			if(isset($_SERVER['HTTP_BV_TYPE']))
				$type = $_SERVER['HTTP_BV_TYPE'];
				
			// Write usage data to database.
			
			
			log_message("debug", "Attempting to fetch image for bar ".$bar_id);
			
			// Write header
			header("Content-type: image/jpeg");
			header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
			header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
			
			$path = base_url() . 'broadcast_images/';
			echo file_get_contents($path.$bar_id.".jpg");
		}
	}
?>