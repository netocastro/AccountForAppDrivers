<?php

namespace Source\Controllers\Admin;

use League\Plates\Engine;
use Source\Models\Apps;
use Source\Models\AppsAccount;
use Source\Models\Historic;
use Source\Models\User;
use Source\Models\UserApps;
use Source\Models\UserDates;

class Web{
	
	private $view;

	function __construct($router){
		$this->view = Engine::create(dirname(__DIR__ , 3) .'/themes/theme1/admin','php');	
		$this->view->addData(["router" => $router]);
	}

	public function home(){

		$userApps = (isset($_SESSION['user_id'])) ? (new UserApps())->find('user_id = :user_id','user_id='.$_SESSION['user_id'])->fetch(true) : false;

		echo $this->view->render('home',[	
			"title" => "Admin | Home",
			"userApps" => $userApps
		]);
	}

	public function informations(){

		$user = (new User())->findById($_SESSION['user_id']);
		$userApps = (new UserApps())->find("user_id = :user_id","user_id={$_SESSION['user_id']}")->fetch(true);
		$userDates = (new UserDates())->find("user_id = :user_id","user_id={$_SESSION['user_id']}")->fetch(true);


		echo $this->view->render('informations',[	
			"title" => "Admin | Informations",
			"user" => $user,	
			"userApps" => $userApps,
			"userDates" => $userDates,
			"teste" => 'teste'
		]);
	}
}
