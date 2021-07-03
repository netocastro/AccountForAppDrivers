<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Date extends DataLayer
{
	function __construct()
	{
		parent::__construct('dates', ['date'], 'id', false);
	}
}
