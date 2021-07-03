<?php

namespace Source\Controllers\Admin;

use Source\Models\AppsAccount;
use Source\Models\Date;
use Source\Models\Historic;
use Source\Models\UserApps;
use Source\Models\UserDates;

class Request
{
    public function registerDay($data)
    {
        $session = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

        $totalAccounts = 0;

        $findEmptyFields = array_keys($data, '');

        if ($findEmptyFields) {
            echo json_encode(['emptyFields' => $findEmptyFields]);
            return;
        }

        $validateFields = [];

        $date = (new Date())->find('date = :date', 'date=' . $data['date'])->fetch();

        if (!$date) {
            $date = new Date();

            $date->date = $data['date'];
            $date->save();

            if ($date->fail()) {
                echo json_encode('Date: ' . $date->fail()->getMessage());
                return;
            }
        }

        $userDate = (new UserDates())->find('user_id = :user_id and date_id = :date_id', "user_id={$session}&date_id={$date->id}")->fetch();

        if (!$userDate) {
            $userDate = new UserDates();

            $userDate->user_id = $session;
            $userDate->date_id = $date->id;

            $userDate->save();

            if ($userDate->fail()) {
                echo json_encode('UserDate: ' . $userDate->fail()->getMessage());
                return;
            }
        } else {
            $validateFields['date'] = 'Usuário já cadastrou essa data';
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        foreach ((new UserApps())->find('user_id = :user_id', "user_id={$session}")->fetch(true) as $UserApp) {

            $appsAccount = new AppsAccount();

            $appsAccount->user_date_id = $userDate->id;
            $appsAccount->user_app_id = $UserApp->id;
            $appsAccount->money = $appsAccount->newAppAccount($data[$UserApp->appName()], $data['date'], $UserApp->id);

            $appsAccount->save();

            $totalAccounts += $appsAccount->money;

            if ($appsAccount->fail()) {

                $userDate->destroy();

                echo json_encode('appsAccount: ' . $appsAccount->fail()->getMessage());
                return;
            }
        }

        $historic = new Historic();

        $historic->user_date_id = $userDate->id;
        $historic->money =  $data['money'];
        $historic->expenses =  $data['expenses'];
        $historic->balance =  $data['total'] - $data['expenses'] - $data['money'] - $totalAccounts;

        $historic->save();

        if ($historic->fail()) {

            $userDate->destroy();
            $appsAccount->destroy();

            echo json_encode('Historic: ' . $historic->fail()->getMessage());
            return;
        }
        echo json_encode(['success' => 'Registrado com sucesso']);
    }
}
