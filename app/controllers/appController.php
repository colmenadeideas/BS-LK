<?php

	class appController extends Controller {

		public function __construct() {
			
			parent::__construct();
			//Auth::handleLogin('panel');
	        $this->view->title = "LIKES";	 //Temporarly defined to avoid individual var
	       // $this->view->user = $this->user->getUserdata(); //TODO Change  $this->view->username por $this->view->user
	        //$this->view->userdata  = array("id"=>"22", "username" => "dlarez", "role" => "doctor" 	);
			
		}
		
		public function index(){
	        
			//$this->view->userdata = $this->user->getUserdata();	

			//$this->view->posts = Api::posts("array", "from", "dlarez@besign.com.ve");
			//print_r($this->view->posts );

			$this->view->render("app/head");
			$this->view->render("app/nav");
			$this->view->render("app/post/list"); // buildpage
			$this->view->render("app/footer");
		}
	}
?>