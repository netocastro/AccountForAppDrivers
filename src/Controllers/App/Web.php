<?php	

namespace Source\Controllers\App;

use League\Plates\Engine;

class Web{
	
	/**
	 * @var Engine
	 */
	private $view;

	/**
	 * @var Router
	 */
	private $router;

	function __construct($router){
		$this->view = Engine::create(dirname(__DIR__ , 3) .'/themes/theme1/app','php');	
		$this->view->addData(["router" => $router]);
		$this->router = $router;
	}

	public function home(){
		echo $this->view->render('home',[	
			"title" => "App Gerence | Principal"
		]);																																																																																						
	}

	public function register(){
		echo $this->view->render('register',[	
			"title" => "App Gerence | Registro",
		]);
	}

	public function map(){
		echo $this->view->render('map',[	
			"title" => "App Gerence | Mapa",
		]);
	}


	public function logout(){
		unset($_SESSION['user_id']);

		$this->router->redirect('app.web.home');
	}
}
