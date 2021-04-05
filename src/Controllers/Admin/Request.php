<?php

namespace Source\Controllers\Admin;


use Source\Models\AppsAccount;
use Source\Models\Date;
use Source\Models\Historic;
use Source\Models\UserApps;
use Source\Models\UserDates;

class Request
{

    public function registerDay($data){

        $session = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
        $saves = [];
        $totalAccounts = 0;

        $findEmptyFields = array_keys($data, '');

        if ($findEmptyFields) {
            echo json_encode(['findEmptyFields' => $findEmptyFields]);
            return;
        }

        /*	$validateFields = [];
            $validateFields['invalidMoney'] = validateMoney($data['money']);
            $validateFields['invalidExpenses'] = validateMoney($data['expenses']);
            $validateFields['invalidTotal'] = validateMoney($data['total']);*/

        /*	foreach ($validateFields as $field) {
                if(!$field){
                    echo json_encode($validateFields);
                    return;
                }
            }*/

        $date = (new Date())->find('date = :date', 'date=' . $data['date'])->fetch();

        if (!$date) {
            $date = new Date();

            $date->date = $data['date'];
            $date->save();

            if ($date->fail()) {
                echo json_encode('Date: ' . $date->fail()->getMessage());
                return;
            } else {
                $saves['date'] = 'save_date';
            }
        }

        $userDate = (new UserDates())->find('user_id = :user_id and date_id = :date_id',"user_id={$session}&date_id={$date->id}")->fetch();

        if(!$userDate){
            $userDate = new UserDates();
            $userDate->user_id = $session;
            $userDate->date_id = $date->id;
            $userDate->save();

            if ($userDate->fail()) {
                echo json_encode('UserDate: ' . $userDate->fail()->getMessage());
                return;
            } else {
                $saves['userDate'] = 'save_userDate';
            }
        }else{
            echo json_encode('UserDate have register for this day');
            return;
        }   

        foreach ((new UserApps())->find('user_id = :user_id', "user_id={$session}")->fetch(true) as $app) {
            
            $appsAccount = new AppsAccount();   

            echo json_encode($appsAccount->moneyDayApp($data[$app->appName()], $data['date'], $app->app_id));   

            $appsAccount->user_date_id = $userDate->id;
            $appsAccount->user_app_id = $app->id;
            $appsAccount->money = $appsAccount->moneyDayApp($data[$app->appName()], $data['date'], $app->app_id);
           
            $appsAccount->save();

            $totalAccounts += $appsAccount->money;

            if ($appsAccount->fail()) {

                $userDate->destroy();

                echo json_encode('appsAccount: ' . $appsAccount->fail()->getMessage());
                return;
            } else {
                $saves['appsAccount'] = 'save_appsAccount';
            }
        }

        $historic = new Historic();

        $historic->money =  $data['money'];
        $historic->expenses =  $data['expenses'];
        $historic->balance =  $data['total'] - $data['expenses'] - $data['money'] - $totalAccounts;
        $historic->user_date_id = $userDate->id;

        $historic->save();

        if ($historic->fail()) {

            $userDate->destroy();
            $appsAccount->destroy();

            echo json_encode('Historic: ' . $historic->fail()->getMessage());
            return;
        } else {
            $saves['historic'] = 'save_historic';
        }
        echo json_encode(['saves' => $saves]);
    }
}
