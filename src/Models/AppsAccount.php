<?php

namespace Source\Models;

use DateTime;
use Stonks\DataLayer\DataLayer;

class AppsAccount extends DataLayer{
	
	function __construct(){
		parent::__construct('Apps_accounts', ['user_date_id', 'user_app_id', 'money'], 'id');
    }
    
   /* public function userDateId(){
        return (new UserDates())->find('id = :id',"id={$this->user_date_id}")->fetch();
    }

	public function date(){
        return (new Date())->find('id = :id',"id={$this->userDateId()}")->fetch();
    }
    
    public function userAppName(){
        return (new UserApps())->find('id = :id',"id={$this->user_app_id}")->fetch()->appName();
    }

    public function moneyDayApp($correntAccount, $currentDate, $app_id) {

        $courrentWeek = new DateTime($currentDate);

        if($courrentWeek->format('w') == 1){
            return $correntAccount;
        }
        
        $previousDays = (new AppsAccount())->find('user_app_id = :user_app_id', "user_app_id={$app_id}")->order('id DESC')->limit(6)->fetch(true);

        if($previousDays){
            foreach ($previousDays as $key){
                if((new DateTime($key->date()))->format('W')  == $courrentWeek->format('W')){
                    $correntAccount -= $key->money;
                }
            }
        }
        return $correntAccount;
    }*/
}
