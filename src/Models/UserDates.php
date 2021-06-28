<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class UserDates extends DataLayer{
	
	function __construct(){
		parent::__construct('user_dates',['user_id','date_id'], 'id' ,false);
	}

	public function historic()
	{
		return (new Historic())->find('user_date_id = :udi', "udi={$this->id}")->fetch();
	}

	public function appsAccounts()
	{
		return (new AppsAccount())->find('user_date_id = :udi', "udi={$this->id}")->fetch(true);
	}

	public function date(){
		return (new Date())->find('id = :id','id='. $this->date_id)->fetch()->date;
	}
}
