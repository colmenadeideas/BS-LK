<?php

	class boardsController extends Controller {

		public function __construct() {			
			parent::__construct();

			$this->view->user = $this->user->getUserdata();
		}
		
		public function add() {

			//recibir post
			//if skip corre board.add()
			//sino corre add mas add users

			$array_data = array();	

			$user = $this->view->user[0]['id'];
			$array_data['data']['namespace'] = escape_value($_POST['namespace']);
			$array_data['data'] = json_encode($array_data['data'], TRUE);
			
			$lastRelationshipID = ApiQuery::lastRelationship();
			$array_data['relationship'] = $lastRelationshipID[0]['id']+1;

			$insert = $this->helper->insert("boards", $array_data);
			$boardID = DB::insertId();	
			
			//RELATIONSHIP DATA
			$array_relationship['users']['owner'][]['id'] = $user;
			//antes
			//$array_relationship['users']['owner'] = $user; AL 130417 DELIA
			$array_relationship['relationships']['boards'] = $boardID;
			$array_relationship['roles']['owner'][]['id'] = $user;
			//antes
			//$array_relationship['roles']['owner'] = $user; AL 130417 DELIA

			$array_relationship['users'] 		 = json_encode($array_relationship['users'], TRUE);
			$array_relationship['relationships'] = json_encode($array_relationship['relationships'], TRUE);
			$array_relationship['roles'] 		 = json_encode($array_relationship['roles'], TRUE);
			
			$insertRelationship = $this->helper->insert("relationships", $array_relationship);

			if($insert > 0) {
				
				$response["tag"] = "boards";
				$response["success"] = 1;
				$response["error"] = 0;	
				$response["response"] = "success";
				$response["board"] = $boardID;

					//$response = Api::comment("json", DB::insertId());
				//$response["comments"] = Api::comments("json","post",$array_data['post']);
				echo json_encode($response, JSON_UNESCAPED_UNICODE);		
			}
		}

	}
?>