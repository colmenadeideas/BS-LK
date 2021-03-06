<?php
	
	class Controller  {
	
		public function __construct(){
			
			$this->view = new View();
			$this->helper = new Helper();
			$this->fileuploader = new Fileuploader();
			$this->email = new Email();
			$this->user = new User();		
			$this->api = new Api();

			$this->instagram = new Instagram(array(
				'apiKey' => INSTAGRAM_CLIENT_ID,
				'apiSecret' => INSTAGRAM_CLIENT_SECRET,
				'apiCallback' => INSTAGRAM_REDIRECT_URI
			));
			
			$this->user->init();//Added 26-10-13 to keep sessions through Controllers
		}
				 		
		/**
		 * 
		 * @param string $name Name of the model
		 * @param string $path Location of the models	
		 */
		public function loadModel($name, $modelPath = '../app/models/') {
			
			$path = $modelPath . $name.'Model.php';
			
			if (file_exists($path)) {
				require $modelPath .$name.'Model.php';
				
				$modelName = $name . 'Model';
				
				$this->model = new $modelName();
			}        
		}						
	}
	
?>