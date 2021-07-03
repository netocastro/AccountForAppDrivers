<?php

namespace Source\Controllers\App;

use Source\Models\User;
use Source\Models\UserApps;

class Request
{
	public function login($data)
	{
		$data = filter_var_array($data, [
			"email" => FILTER_SANITIZE_EMAIL,
			"password" => FILTER_SANITIZE_STRIPPED,
		]);

		$findEmptyFields = array_keys($data, '');

		if ($findEmptyFields) {
			echo json_encode(['emptyFields' => $findEmptyFields]);
			return;
		}

		$validateFields = [];

		$user = (new User())->find('email = :e', "e={$data['email']}")->fetch();

		if (!$user || !password_verify($data['password'], $user->password)) {
			$validateFields['email'] = '';
			$validateFields['password'] = 'Informações inválidas';
		}

		if ($validateFields) {
                  echo json_encode(['validateFields' => $validateFields]);
                  return;
            }

		if ($user) {
			$_SESSION['user_id'] = $user->id;
			echo json_encode('redirect');
		}
	}

	public function register($data)
	{
		$save = [];
		$findEmptyFields = array_keys($data, '');

		if ($findEmptyFields) {
			echo json_encode(['emptyFields' => $findEmptyFields]);
			return;
		}

		$data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRIPPED);
		$data['cpf'] = filter_var($data['cpf'], FILTER_SANITIZE_STRIPPED);
		$data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
		$data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRIPPED);
		$data['repeat_password'] = filter_var($data['repeat_password'], FILTER_SANITIZE_STRIPPED);

		/*$data = filter_var_array($data, [               // falta descobrir como aplicar esse filtro em um check box com array
			"name" => FILTER_SANITIZE_STRIPPED,
			"cpf" => FILTER_SANITIZE_STRIPPED,
			"email" => FILTER_SANITIZE_EMAIL,
			"password" => FILTER_SANITIZE_STRIPPED,
			"repeat_password" => FILTER_SANITIZE_STRIPPED,
			"apps" => FILTER_DEFAULT
		]);*/

		$validateFields = [];

		if (!validateEmail($data['email'])) {
			$validateFields['email'] = 'Formato de email inválido';
		}

		if ((new User())->find('email = :e', "e={$data['email']}")->fetch()) {
			$validateFields['email'] = 'Email já foi cadastrado';
		}

		if (!validateCpf($data['cpf'])) {
			$validateFields['cpf'] = 'Formato de CPF inválido. ex: 000.000.000-00';
		}

		if ((new User())->find('cpf = :c', "c={$data['cpf']}")->fetch()) {
			$validateFields['cpf'] = 'CPF já foi cadastrado';
		}

		if (!validateName($data['name'])) {
			$validateFields['name'] = 'Formato do nome inválido';
		}

		if ((new User())->find('name = :name', "name={$data['name']}")->fetch()) {
			$validateFields['name'] = 'Nome ja cadastrado';
		}

		if ($data['password'] != $data['repeat_password']) {
			$validateFields['repeat_password'] = "Senhas não conferem";
		}

		if ($data['apps'] == ['']) {
			$validateFields['apps'] = "Escolha no mínimo um app";
		}

		if ($validateFields) {
			echo json_encode(['validateFields' => $validateFields]);
			return;
		}

		$user = new User();

		$user->email = $data['email'];
		$user->cpf = $data['cpf'];
		$user->name = $data['name'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);

		$user->save();

		if ($user->fail()) {
			echo json_encode("User: " . $user->fail()->getMessage());
			return;
		}

		foreach ($data['apps'] as $app_id) {
			if ($app_id != '') { // IF temporario, ate resolver a questão da filtragem do check box na linha 60
				$userApps = new UserApps();

				$userApps->user_id = $user->id;
				$userApps->app_id = $app_id;

				$userApps->save();

				if ($userApps->fail()) {
					$user->destroy();
					echo json_encode("App {$app_id}: " . $userApps->fail()->getMessage());
					return;
				}
			}
		}
		echo json_encode('success');
	}
}
