<?php

namespace Source\Models;
use Source\Models\UserApps;

use Stonks\DataLayer\DataLayer;

class User extends DataLayer{
	
	function __construct(){
		parent::__construct('users',['cpf','email','name','password'],'id',false);
	}

	/*public function userApps()
	{
		return (new UserApps())->find('user_id = :uid',"uid={$this->id}")->fetch(true);
	}*/

}
