<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Historic extends DataLayer{
	
	function __construct(){

		parent::__construct('historic', ['user_date_id', 'money', 'expenses', 'balance'], 'id');
	}
}	
