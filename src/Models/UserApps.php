<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class UserApps extends DataLayer
{

   public function __construct()
   {
      parent::__construct('user_apps', ['app_id', 'user_id'], 'id');
   }

   public function appName() : string
   {
      return (new Apps())->find('id = :id' , "id={$this->app_id}")->fetch()->name;
   }

}
