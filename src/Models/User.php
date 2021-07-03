<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class User extends DataLayer
{
	function __construct()
	{
		parent::__construct('users', ['cpf', 'email', 'name', 'password'], 'id', false);
	}
}
