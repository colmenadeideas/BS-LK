<?php

	class commentsController extends Controller {

		public function __construct() {			
			parent::__construct();
		}
		
		public function add($post_id) {
			//print_r($_POST);
			$array_data = array();	

			$array_data['post'] = escape_value($post_id);
			$array_data['user'] = "1";
			//TODO set timestamp from function? will this give right GTM ZONE for front user?
			$array_data['data']['text'] = escape_value($_POST['text']);
			$array_data['data'] = json_encode($array_data['data']);
			$insert = $this->helper->insert("comments", $array_data);

			if($insert > 0) {
				/*
				$response["tag"] = "comments";
				$response["success"] = 1;
				$response["error"] = 0;	
				$response["response"] = "success";		*/

				$response = Api::comment("json", DB::insertId());
				//$response["comments"] = Api::comments("json","post",$array_data['post']);
				//echo json_encode($response);
						
			}

		}

	}
?>