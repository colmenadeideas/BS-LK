<?php

	class appController extends Controller {

		public function __construct() {
			
			parent::__construct();
			Auth::handleLogin('app');
	        $this->view->title = "LIKES";	 //Temporarly defined to avoid individual var
	        $this->view->user = $this->user->getUserdata(); //TODO Change  $this->view->username por $this->view->user
	        //$this->view->userdata  = array("id"=>"22", "username" => "dlarez", "role" => "doctor" 	);
			
		}
		
		public function index() {
			$this->view->render("app/head");
			$this->view->render("app/nav");
			$this->view->render("app/clear");
			$this->view->render("app/footer");
		}

		public function welcome() {
			$hasBoards = Api::boards("array", "from", $this->view->user[0]['id']);
			if ($hasBoards[0]['empty'] == 1){
			//No boards, show tutorial
				$this->view->render("app/welcome/tutorial");
			} else {
			//else show latest activity
				$this->view->render("app/welcome/activity");
			}
		}

		public function boards($action = '') {
			switch ($action) {
				case 'add':
					$this->view->render("app/board/add");
					break;				
				default:
					$this->view->render("app/board/list");
					break;
			}
		}


		public function posts($action,$id, $modal ="", $modal_id =""){
			switch ($action) {
				case 'addto':
					if ($id == ""){
						$this->view->render("app/post/add-choose");
					} else {
						$this->view->render("app/post/add");
					}
					break;

				//With Open Modal
				case 'board':
					$this->view->render("app/post/list");
					break;
				
				default: // "board"
					$this->view->render("app/post/list");
					break;
			}
		}
		public function relationships($action="add", $id){
			
			switch ($action) {

				case 'add':
					$this->view->render("app/relationship/empty");
					

					break;
				case 'addto':
					if ($id == ""){
						$this->view->render("app/relationship/add-choose");
					} else {
						$this->view->render("app/relationship/add");
					}
					break;
			}

		}

	}
?>