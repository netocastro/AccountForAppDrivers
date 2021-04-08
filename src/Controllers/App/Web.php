<?php	

namespace Source\Controllers\App;

use League\Plates\Engine;
use Source\Models\User;
use Source\Models\Date;
use Source\Models\AppsAccount;
use Source\Models\Historic;

class Web{

	private $view;
	private $router;

	function __construct($router){
		$this->view = Engine::create(dirname(__DIR__ , 3) .'/themes/theme1/app','php');	
		$this->view->addData(["router" => $router]);
		$this->router = $router;
	}

	public function home(){
		echo $this->view->render('home',[	
			"title" => "App Gerence | Principal"/*,
			"users" => (new User())->find()->fetch(true),
			"dates" => (new Date())->find()->fetch(true),
			"apps_accounts" => (new AppsAccount())->find()->fetch(true),
			"historic" => (new historic())->find()->fetch(true),*/
		]);																																																																																						
	}

	public function register(){
		echo $this->view->render('register',[	
			"title" => "App Gerence | Registro",
		]);

	}

	public function logout(){
		unset($_SESSION['user_id']);

		$this->router->redirect('app.web.home');


	}
}