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

		if(!validateEmail($data['email'])){
			$validateFields['email'] = 'Formato de email inválido';
		}

		if((new User())->find('email = :e',"e={$data['email']}")->fetch()){
			$validateFields['email'] = 'Email já foi cadastrado';
		}

		if(!validateCpf($data['cpf'])){
			$validateFields['cpf'] = 'Formato de CPF inválido';
		}

		if((new User())->find('cpf = :c',"c={$data['cpf']}")->fetch()){
			$validateFields['cpf'] = 'CPF já foi cadastrado';
		}

		if(!validateName($data['name'])){
			$validateFields['name'] = 'Formato do nome inválido';
		}

		if ($data['password'] != $data['repeat_password']) {
			$validateFields['repeat_password'] = "Senhas não conferem";
		}

		if(empty($data['apps'])){
			$validateFields['apps'] = "Escolha no minimo um app";
		}

		if($validateFields){
			echo json_encode(['validateFields' => $validateFields]);
			return;
		}

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
				$user->destroy();
				echo json_encode("App {$app_id}: " . $userApps->fail()->getMessage());
				return;
			} else {
				$save[] = "App{$app_id}_save";
			}			
		}
		echo json_encode('success');
	}
}
