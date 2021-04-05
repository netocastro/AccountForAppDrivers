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

		$userApps = (isset($_SESSION['user_id'])) ? (new User())->find('id = :id','id='.$_SESSION['user_id'])->fetch()->userApps() : false;

		echo $this->view->render('home',[	
			"title" => "Admin | Home",
			"user_apps" => $userApps,
			"apps" => new Apps()
		]);
	}

	public function viewBalance(){

		$user = (new User())->findById($_SESSION['user_id']);
		$userApps = (new UserApps())->find("user_id = :user_id","user_id={$_SESSION['user_id']}")->fetch(true);
		$userDates = (new UserDates())->find("user_id = :user_id","user_id={$_SESSION['user_id']}")->fetch(true);

		/** @var User $user  */
		/*$userDates = $user->userDates();

		foreach ($userDates as $userDate) {

			$historic = $userDate->historic();

			$appAccounts = $userDate->appsAccounts();
			
			foreach ($appAccounts as $appAccount ) {
				echo "{$appAccount->userAppName()} " . $appAccount->money . "<br>";
			}

			echo "Data: " . $userDate->date . "<br>";
			echo "Money: " . $historic->money . "<br>";
			echo "expenses: " . $historic->expenses . "<br>";
			echo "balance: " . $historic->balance . "<br>";
			echo "<hr>";			
		}

		exit;*/

		echo $this->view->render('viewBalance',[	
			"user" => $user,
			"userApps" => $userApps,
			"userDates" => $userDates
		]);
	}
}