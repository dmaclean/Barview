<?php 
	require(APPPATH.'libraries/REST_Controller.php'); 

	class Rest extends REST_Controller {
		function Rest() {
			parent::__construct();
			
			$this->load->model('barimage_model');
			$this->load->model('favorite_model');
		}
	
		/**
		 * Retrieves the image specified in the URL and sends back to the
		 * user an XML document containing the bar id and the image encoded
		 * as a Base64 string.  If there is no image for the requested bar
		 * then the <barimage> field is empty.
		 */
		public function barimage_get() {
			$bar_id = $this->uri->segment(3);
			log_message('info','Received a request for bar image '.$bar_id);
			
			$this->barimage_model->set_bar_id($bar_id);
			$image = $this->barimage_model->fetch_image_from_filesystem();
			
			header("Content-type: text/xml");
			$xml = '<?xml version="1.0" encoding="UTF-8" ?><barimage><bar_id>'.$bar_id.'</bar_id>';
			
			if($image == '')
				$xml = $xml.'<image></image></barimage>';
			else
				$xml = $xml.'<image>'.base64_encode($image).'</image></barimage>';
			
			echo $xml;
		}
		
		/**
		 * Experimental GET handler that just sends the Base64 representation of the image
		 * in the response, instead of an XML response.  This is far more efficient for the
		 * Android clients because the XML parser is painfully slow.  Simply handling the
		 * entire response is much better since the bar id is not necessary to send back.
		 */
		public function barimagebinary_get() {
			$bar_id = $this->uri->segment(3);
			log_message('info','Received a request for bar image '.$bar_id);
			
			$this->barimage_model->set_bar_id($bar_id);
			$image = $this->barimage_model->fetch_image_from_filesystem();
			
			echo base64_encode($image);
		}
		
		/**
		 * Saves an image sent in the request as POST data.  Images are stored in the
		 * broadcast_images directory.
		 */
		public function barimage_post() {
			$bar_id = $this->uri->segment(3);
			$this->do_logging('Received an image from bar '.$bar_id.'\n');
			
			// Get the session id and bar name from headers sent in with the request to validate the request.
			if(!isset($_SERVER['HTTP_SESSION_ID']) || !isset($_SERVER['HTTP_BAR_NAME']) || !$this->validate_session($_SERVER['HTTP_SESSION_ID'], $_SERVER['HTTP_BAR_NAME']) ) {
				$this->do_logging('POST failed.  Could not verify user\'s authenticity.');
				echo 'POST failed.  Could not verify user\'s authenticity.';
				return;
			}
			
			// Looks like the request is valid, get the raw data from the POST and update the bar's image.
			if(isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
				// Extract data from POST and save to filesystem.
				$jpg = $GLOBALS["HTTP_RAW_POST_DATA"];
				$filename = "broadcast_images/".$bar_id.".jpg";
				file_put_contents($filename, $jpg);
			} else {
				echo "Encoded JPEG information not received.";
			}
		}
		
		
		
		
		
		/******************************************************************************************
		 * FAVORITES
		 *
		 * The REST interface for servicing favorites requests will satisfy the following needs:
		 *
		 * - GET requests for a list of all favorites for a user.
		 * - POST requests for a single favorite.
		 * - DELETE requests for a single favorite.
		 *
		 * For these requests, the user id value is sent as an HTTP header.
		 *****************************************************************************************/
		public function favorites_get() {
			// Get user_id from header
			$headers = apache_request_headers();
			$user_id = $headers['User_id'];
			log_message('debug', 'Received a request for favorites of user '.$user_id);
			
			$xml = '<?xml version="1.0" encoding="UTF-8" ?><favorites>';
			
			$results = $this->db->query('select bars.bar_id as "bar_id", name, address from bars inner join favorites on bars.bar_id = favorites.bar_id where user_id = '. $this->db->escape($user_id));
			foreach ($results->result() as $row) {
				$xml = $xml.'<favorite><bar_id>'.$row->bar_id.'</bar_id>';
				$xml = $xml.'<address>'.$row->address.'</address>';
				$xml = $xml.'<name>'.$row->name.'</name></favorite>';
			}
			
						
			$xml = $xml.'</favorites>';
			echo $xml;
		}
		
		public function favorite_post() {
			// Get user_id from header
			$headers = apache_request_headers();
			$user_id = $headers['User_id'];
			$bar_id = $this->uri->segment(3);
			log_message('debug', 'Received a request to add bar '.$bar_id.' to favorites for user '.$user_id);
			
			$this->favorite_model->set_user_id($user_id);
			$this->favorite_model->set_bar_id($bar_id);
			$this->favorite_model->create();
		}
		
		public function favorite_delete() {
			// Get user_id from header
			$headers = apache_request_headers();
			$user_id = $headers['User_id'];
			$bar_id = $this->uri->segment(3);
			log_message('debug', 'Received a request to add bar '.$bar_id.' to favorites for user '.$user_id);
			
			$this->favorite_model->set_user_id($user_id);
			$this->favorite_model->set_bar_id($bar_id);
			$this->favorite_model->delete();
		}
		
		
		
		
		/***********************************************************************************************************
		 * NEARBY BARS
		 *
		 * The REST interface for servicing nearby bar requests will satisfy the following needs:
		 *
		 * - GET requests for a list of all bars within X miles of a given set of latitude/longitude coordinates.
		 * 
		 * This interface will not respond to any POST, PUT or DELETE requests.
		 **********************************************************************************************************/
		 public function nearbybars_get() {
		 	// Get user_id from header
			$headers = apache_request_headers();
			$lat = $headers['Latitude'];
			$lng = $headers['Longitude'];
			$lat_low = $this->db->escape($lat - BAR_RADIUS);
			$lat_high = $this->db->escape($lat + 0.025);
			$lng_low = $this->db->escape($lng - 0.025);
			$lng_high = $this->db->escape($lng + 0.025);
			
			$xml = '<?xml version="1.0" encoding="UTF-8" ?><nearbybars>';
			
			$sql = 'select * from bars where lat <= '.$lat_high.' and lat >= '.$lat_low.
						' and lng <= '.$lng_high.' and lng >= '.$lng_low;
			$results = $this->db->query($sql);

			foreach ($results->result() as $row) {
				$xml = $xml.'<bar>';
				$xml = $xml.'<bar_id>'.$row->bar_id.'</bar_id>';
				$xml = $xml.'<name>'.$row->name.'</name>';
				$xml = $xml.'<address>'.$row->address.'</address>';
				$xml = $xml.'<lat>'.$row->lat.'</lat>';
				$xml = $xml.'<lng>'.$row->lng.'</lng>';
				$xml = $xml.'</bar>';
			}

			
			$xml = $xml.'</nearbybars>';
			
			echo $xml;
		 }
		 
		 /**
		  * Ensures that the POST request coming in to update a bar image is authentic.  By demanding
		  * that the user includes the correct session_id and bar name along with the request we can
		  * check those values against the database to make sure the request is coming from a logged-in
		  * bar and not some random person sending cock shots.
		  */
		 private function validate_session($session, $bar) {
		 	$sql = 'select bar_name from ci_sessions where session_id = '.$this->db->escape($session).' and bar_name = '.$this->db->escape($bar);
		 	
		 	$query = $this->db->query($sql);
		 	if($query->num_rows() > 0)
		 		return true;
		 	
		 	return false;
		}
		
		private function do_logging($msg) {
			$myFile = "system/logs/restlog.txt";
			$fh = fopen($myFile, 'a');
			
			fwrite($fh, date(DATE_RFC822).' - '.$msg.'\n');
		}
	}
?>