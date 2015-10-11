<?php
	class siteController extends Controller {
		public function __construct() {
	
			parent::__construct();
		}

		public function index() {			
			//TODO escape values	
			$this->login();
		}

		public function login() {

			// create login URL
			$loginUrl = $this->instagram->getLoginUrl();

			$this->view->button =  $loginUrl;

			//TODO escape values	
			$this->view->render('default/head');
			$this->view->render('default/nav');
			$this->view->render('site/login');
			$this->view->render('default/footer');
		}

	}

?>