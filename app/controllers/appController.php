<?php

	class appController extends Controller {

		public function __construct() {
			
			parent::__construct();
			//Auth::handleLogin('panel');
	        $this->view->title = "LIKES";	 //Temporarly defined to avoid individual var
	       // $this->view->user = $this->user->getUserdata(); //TODO Change  $this->view->username por $this->view->user
	        //$this->view->userdata  = array("id"=>"22", "username" => "dlarez", "role" => "doctor" 	);
			
		}
		
		public function index() {
			$this->view->render("app/head");
			$this->view->render("app/nav");
			$this->view->render("app/board/list"); // buildpage
			$this->view->render("app/footer");
		}

		public function boards() {
			//$this->view->userdata = $this->user->getUserdata();	
			
			$this->view->render("app/board/list"); // buildpage
			
		}


		public function posts($action,$id){
			switch ($action) {
				case 'addto':
					$this->view->render("app/post/add");
					break;
				
				default: // "board"
					$this->view->render("app/post/list"); // buildpage
					break;
			}
		}

	}
?>