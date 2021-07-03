<?php

namespace Source\Controllers\Admin;

use League\Plates\Engine;
use Source\Models\User;
use Source\Models\UserApps;
use Source\Models\UserDates;

class Web
{
	/**
	 * @var Engine
	 */
	private $view;

	/**
	 * @var String
	 */
	private $sessionId;

	function __construct($router)
	{
		$this->view = Engine::create(dirname(__DIR__, 3) . '/themes/theme1/admin', 'php');
		$this->view->addData(["router" => $router]);
		$this->sessionId = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');
	}

	public function home()
	{
		$user = (new User())->findById($this->sessionId);
		$userApps = (isset($this->sessionId)) ? (new UserApps())->find('user_id = :user_id', 'user_id=' . $this->sessionId)->fetch(true) : false;

		echo $this->view->render('home', [
			"title" => "Admin | Home",
			"user" => $user,
			"userApps" => $userApps
		]);
	}

	public function informations() 
	{         
		$user = (new User())->findById($this->sessionId);
		$userApps = (new UserApps())->find("user_id = :user_id", "user_id={$this->sessionId}")->fetch(true);
		$userDates = (new UserDates())->find("user_id = :user_id", "user_id={$this->sessionId}")->fetch(true);

		echo $this->view->render('informations', [
			"title" => "Admin | Informations",
			"user" => $user,
			"userApps" => $userApps,
			"userDates" => $userDates
		]);
	}
}
