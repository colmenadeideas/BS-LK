<?php
	class apiController extends Controller {
		public function __construct() {
	
			parent::__construct();
		}
		// AUTOCOMPLETE: This function is invoked when user is writing fields related to : Doctor's name, Clinics, Addresses and Doctor's Speciality
		public function autocomplete($print="json", $what="all") {
			
			
			$string = trim($_GET['term']);	
			
			//TODO escape values	
			$this -> api -> autocomplete($print, $what, $string);
		}
		// SEARCH: Main search processing is done with this function
		public function search($type = "other", $terms, $location = "VE") {

			$this -> api -> search($type, $terms, $location);
		}
		
				
		public function boards($print="json", $from = "from", $who){
			Api::boards($print, $from, $who);
		}
		public function posts($print="json", $from = "from", $who){
			Api::posts($print, $from, $who);
		}
		public function post($print="json", $id){
			Api::post($print, $id);
		}
		public function comments ($print="json", $from = "post", $id){
			Api::comments($print,$from,$id);
		}
				
	}
?>