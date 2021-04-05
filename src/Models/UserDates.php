<?php

namespace Source\Models;

use DateTime;
use Stonks\DataLayer\DataLayer;

class UserDates extends DataLayer{
	
	function __construct(){
		parent::__construct('user_dates',['user_id','date_id'], 'id' ,false);
	}

	public function date(){
		return (new Date())->find('id = :id','id='. $this->date_id)->fetch()->date;
	}

	public function mes(){
		$date = new DateTime($this->date());
		return  $date->format('m');
	}

	public function historic(){
		return (new Historic())->find('user_date_id = :user_date_id', 'user_date_id='. $this->id)->fetch();
	}

	public function appsAccounts(){
		return (new appsAccount())->find('user_date_id = :user_date_id', 'user_date_id='. $this->id)->fetch(true);
	}


}
