<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Apps extends DataLayer {
    
    public function __construct(){
        parent::__construct('apps',['name'],'id');
    }

    public function userApps(){
		return (new Apps())->find('user_id = :user_id','user_id='. $this->id)->fetch(true);
	}
}
