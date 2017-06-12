<?php

	class postsController extends Controller {

		public function __construct() {			
			parent::__construct();

			$this->view->user = $this->user->getUserdata();
		}
		
		public function add($boardId) {

			$response = Fileuploader::upload($_FILES['files']);

			if ($response['status'] == "success"){
				$post['parent'] = escape_value($boardId);
				$post['data']['image']	= $response['fileeditedname'];
				$post['data'] = json_encode($post['data'], TRUE);
				//Create Post
				$add = $this->helper->insert("posts", $post);
				$response['board'] = $post['parent'];
				$response['post'] = DB::insertId();
			}
			echo json_encode($response);
		}

		public function complete($filename) {

			$extension = explode(".",$filename);
			$this->view->filename 	= $filename;
			$this->view->extension 	= $extension[1];

			$this->view->filethumb[0] =$extension[0]."."."jpg";
			$this->view->render('app/post/popbox');
		}	

		public function copiaadd($post_id) {
			//print_r($_POST);
			$array_data = array();	

			$array_data['post'] = escape_value($post_id);
			$array_data['user'] = $this->view->user[0]['id'];
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