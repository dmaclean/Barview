<?php 
	class Fbuser_model extends CI_Model {
		private $fbprofile;
		private $id;
		private $first_name;
		private $last_name;
		private $email;
		private $dob;
		private $gender;
		private $city;
		private $state;
		
		private $statelist;
		
		public function Fbuser_model() {
			parent::__construct();
			
			$this->statelist = array(
					"Alabama"=>'AL',
					"Alaska"=>'AK',
					"Arizona"=>'AZ',
					"Arkansas"=>'AR',
					"California"=>'CA',
					"Colorado"=>'CO',
					"Connecticut"=>'CT',
					"Delaware"=>'DE',
					"District Of Columbia"=>'DC',
					"Florida"=>'FL',
					"Georgia"=>'GA',
					"Hawaii"=>'HI',
					"Idaho"=>'ID',
					"Illinois"=>'IL',
					"Indiana"=>'IN',
					"Iowa"=>'IA',
					"Kansas"=>'KS',
					"Kentucky"=>'KY',
					"Louisiana"=>'LA',
					"Maine"=>'ME',
					"Maryland"=>'MD',
					"Massachusetts"=>'MA',
					"Michigan"=>'MI',
					"Minnesota"=>'MN',
					"Mississippi"=>'MS',
					"Missouri"=>'MO',
					"Montana"=>'MT',
					"Nebraska"=>'NE',
					"Nevada"=>'NV',
					"New Hampshire"=>'NH',
					"New Jersey"=>'NJ',
					"New Mexico"=>'NM',
					"New York"=>'NY',
					"North Carolina"=>'NC',
					"North Dakota"=>'ND',
					"Ohio"=>'OH',
					"Oklahoma"=>'OK',
					"Oregon"=>'OR',
					"Pennsylvania"=>'PA',
					"Rhode Island"=>'RI',
					"South Carolina"=>'SC',
					"South Dakota"=>'SD',
					"Tennessee"=>'TN',
					"Texas"=>'TX',
					"Utah"=>'UT',
					"Vermont"=>'VT',
					"Virginia"=>'VA',
					"Washington"=>'WA',
					"West Virginia"=>'WV',
					"Wisconsin"=>'WI',
					"Wyoming"=>'WY');
		}
		
		/*
		 * Check if a FB user has already logged into barview, and therefore has a record
		 * in the fb_users database.
		 */
		public function fbUserExists() {
			$sql = 'select id from fb_users where id = ?';
			$query = $this->db->query($sql, array($this->getId()));
			
			if($query->num_rows() > 0)
				return true;
		}
		
		/*
		 * Inserts a new record into the facebook users table.  This is only used on the first time
		 * a FB user logs in.
		 */
		public function insertFBUserData() {
			$sql = 'insert into fb_users values(?, ?, ?, ?, ?, ?, ?, ?)';
			$query = $this->db->query($sql, array($this->getId(), $this->getFirstName(), $this->getLastName(), $this->getEmail(), $this->getDOB(), $this->getGender(), $this->getCity(), $this->getState()));
		}
		
		/*
		 * Keep the data fresh for our FB users.  We basically need to copy all the FB data that we
		 * ask for because I don't feel like asking the user to make their data available while they're
		 * offline.
		 *
		 * This function is called whenever a user on the website or on a mobile device logs in with
		 * Facebook.
		 */
		public function updateFBUserData() {
			$sql = 'update fb_users set id = ?, first_name = ?, last_name = ?, email = ?, dob = ?, gender = ?, city = ?, state = ? where id = ?';
			$query = $this->db->query($sql, array($this->getId(), $this->getFirstName(), $this->getLastName(), $this->getEmail(), $this->getDOB(), $this->getGender(), $this->getCity(), $this->getState(), $this->getId()));
		}
		
		/*
		 * GETTERS AND SETTERS
		 */
		public function setProfile($fbprofile) {
			$this->fbprofile = $fbprofile;
			
			$this->setId('fb' . $this->fbprofile['id']);
			$this->setFirstName($this->fbprofile['first_name']);
			$this->setLastName($this->fbprofile['last_name']);
			$this->setEmail($this->fbprofile['email']);
			
			if(isset($this->fbprofile['birthday'])) {
				$dob = explode("/", $this->fbprofile['birthday']);
				$this->setDOB($dob[2] . '-' . $dob[0] . '-' . $dob[1]);
			}
			$this->setGender($this->fbprofile['gender']);
			
			if(isset($this->fbprofile['location'])) {
				$addr = explode(", ", $this->fbprofile['location']['name']);
				$this->setCity($addr[0]);
				$this->setState($addr[1]);
			}
		}
		 
		public function getId() {
			return $this->id;
		}
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getFirstName() {
			return $this->first_name;
		}
		
		public function setFirstName($first_name) {
			$this->first_name = $first_name;
		}
		
		public function getLastName() {
			return $this->last_name;
		}
		
		public function setLastName($last_name) {
			$this->last_name = $last_name;
		}
		
		public function getEmail() {
			return $this->email;
		}
		
		public function setEmail($email) {
			$this->email = $email;
		}
		
		public function getDOB() {
			return $this->dob;
		}
		
		public function setDOB($dob) {
			$this->dob = $dob;
		}
		
		public function getGender() {
			return $this->gender;
		}
		
		public function setGender($gender) {
			$this->gender = $gender;
		}
		
		public function getCity() {
			return $this->city;
		}
		
		public function setCity($city) {
			$this->city = $city;
		}
		
		public function getState() {
			return $this->state;
		}
		
		public function setState($state) {
			$this->state = $this->statelist[$state];
		}
	}
?>