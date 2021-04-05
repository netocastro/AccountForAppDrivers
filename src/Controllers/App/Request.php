<?php

namespace Source\Controllers\App;

use Source\Models\User;
use Source\Models\UserApps;

class Request
{

	private $router;

	public function __construct($router){
		
		$this->router = $router;
	}

	public function login($data){

		$validateEmptyFields = array_keys($data, '');

		if ($validateEmptyFields) {
			echo json_encode(['validateEmptyFields' => $validateEmptyFields]);
			return;
		}

		$validateFields = [];
		$validateFields['invalidEmail'] = validateEmail($data['email']);

		foreach ($validateFields as $field) {
			if (!$field) {
				echo json_encode(['validateFields' => $validateFields]);
				return;
			}
		}

		$password = base64_encode(pack('H*', sha1(utf8_encode(trim($data['password'])))));

		$user = (new User)->find('password = :password and email = :email', "password={$password}&email={$data['email']}")->fetch();

		if ($user) {
			$_SESSION['user_id'] = $user->id;
			echo json_encode('redirect');
		} else {
			echo json_encode(['userNotExist' => 'userNotExist']);
		}
	}

	public function register($data){

		$save = [];
		$findEmptyFields = array_keys($data, '');

		if ($findEmptyFields) {
			echo json_encode(['emptyFields' => $findEmptyFields]);
			return;
		}

		$validateFields = [];
		$validateFields['invalidEmail'] = validateEmail($data['email']);
		$validateFields['invalidCpf'] = validateCpf($data['cpf']);
		$validateFields['invalidName'] = validateName($data['name']);

		foreach ($validateFields as $field) {
			if (!$field) {
				echo json_encode(['validateFields' => $validateFields]);
				return;
			}
		}

		if ($data['password'] != $data['repeat_password']) {
			echo json_encode('senhas nao conferem');
			return;
		}

		$filterFilds = filter_var_array($data, [
			"email" => FILTER_SANITIZE_EMAIL,
			"email" => FILTER_VALIDATE_EMAIL,
		]);

		$user = new User();

		$user->email = $data['email'];
		$user->cpf = $data['cpf'];
		$user->name = $data['name'];
		$user->password = base64_encode(pack('H*', sha1(utf8_encode(trim($data['password'])))));

		$user->save();

		if ($user->fail()) {
			echo json_encode("User: " . $user->fail()->getMessage());
			return;
		} else {
			$save[] = "user_save";
		}

		foreach ($data['apps'] as $app_id) {	
			$userApps = new UserApps();

			$userApps->user_id = $user->id;
			$userApps->app_id = $app_id;

			$userApps->save();

			if ($userApps->fail()) {
				echo json_encode("App {$app_id}: " . $userApps->fail()->getMessage());
				return;
			} else {
				$save[] = "App{$app_id}_save";
			}			
		}
		echo json_encode($save);
	}
}
