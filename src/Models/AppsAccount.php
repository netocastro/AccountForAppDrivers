<?php

namespace Source\Models;

use DateTime;
use Stonks\DataLayer\DataLayer;

class AppsAccount extends DataLayer
{

    function __construct()
    {
        parent::__construct('apps_accounts', ['user_date_id', 'user_app_id', 'money'], 'id');
    }

    public function dateId()
    {
        return (new UserDates())->find('id = :di', "di={$this->user_date_id}")->fetch()->date_id;
    }

    public function date()
    {
        return (new Date())->find('id = :id', "id={$this->dateId()}")->fetch()->date;
    }

    public function appId()
    {
        return (new UserApps())->find('id = :id', "id={$this->user_app_id}")->fetch()->app_id;
    }

    public function newAppAccount($moneyApp, $data, $appId)
    {
        $courrentDate = new DateTime($data);
        $newAccount = $moneyApp;

        if ($courrentDate->format('w') == '1') {
            return $moneyApp;
        }

        $appAccounts = (new AppsAccount())->find('user_app_id = :user_app_id', "user_app_id={$appId}")->order('id DESC')->limit(6)->fetch(true);

        if ($appAccounts) {
            foreach ($appAccounts as $appAccount) {
                if ((new DateTime($appAccount->date()))->format('W') == $courrentDate->format('W')) {
                    $newAccount -= $appAccount->money;
                }
            }
        }
        return $newAccount;
    }
}
