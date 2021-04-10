<?php

$session = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';


if ($session) : ?>

    <?php
    /*  $userDates = $user->userDates();

    foreach ($userDates as $userDate) {

        $historic = $userDate->historic();

        $appAccounts = $userDate->appsAccounts();

        foreach ($appAccounts as $appAccount) {
            echo "{$appAccount->userAppName()} " . $appAccount->money . "<br>";
        }

        echo "Data: " . $userDate->date . "<br>";
        echo "Money: " . $historic->money . "<br>";
        echo "expenses: " . $historic->expenses . "<br>";
        echo "balance: " . $historic->balance . "<br>";
        echo "<hr>";
    }*/

    ?>

    <?php $v->layout('_template'); ?>

    <?php

        foreach ($appsAccount as $account) {
            echo "<pre>";
            var_dump($account);
            echo "</pre>";

        }

    var_dump($teste);


    ?>



    <!--  <div class="row">
        <div clasS="col-4">

            <h1 class="text-center">Users</h1>
            <pre>
            <?php var_dump($user) ?>
            </pre>
        </div>
        <div clasS="col-4">
        <h1 class="text-center">UsersApps</h1>
        <pre>
            <?php var_dump($userApps) ?>
            </pre>
        </div>
        <div clasS="col-4">
        <h1 class="text-center">UsersDates</h1>
        <pre>
            <?php var_dump($userDates) ?>
            </pre>
        </div>
    </div> -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-success text-light p-2 mb-3 text-center rounded">
                    <h4>Janeiro</h4>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Data</th>

                            <?php foreach ($userApps as $userApp) : ?>
                                <?= "<th scope='col'>{$userApp->appName()}</th>" ?>
                            <?php endforeach; ?>

                            <th scope="col">dinheiro</th>
                            <th scope="col">Gastos</th>
                            <th scope="col">total</th>
                            <th scope="col">Saldo</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        if ($userDates) :
                            $userDates = $user->userDates();

                            foreach ($userDates as $userDate) {
                                $total = 0;

                                $historic = $userDate->historic();

                                $date = new DateTime($userDate->date);

                                $appAccounts = $userDate->appsAccounts();

                                echo "<tr>";
                                echo "<td> " . $date->format('d-m-Y') . "</td> ";
                                foreach ($appAccounts as $appAccount) {
                                    echo "<td> " . $appAccount->money . "</td> ";
                                    $total += $appAccount->money;
                                }

                                $total += ($historic->money + $historic->expenses + $historic->balance);

                                echo "<td> " . $historic->money . "</td> ";
                                echo "<td> " . $historic->expenses . "</td> ";
                                echo "<td> " . $total . "</td> ";
                                echo "<td> " . $historic->balance . "</td> ";
                                echo "<tr>";
                            }
                        endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="bg-success text-light p-2 mb-3 text-center rounded">
                    <h4>Janeiro</h4>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Data</th>

                            <?php foreach ($userApps as $userApp) : ?>
                                <?= "<th scope='col'>{$userApp->appName()}</th>" ?>
                            <?php endforeach; ?>

                            <th scope="col">dinheiro</th>
                            <th scope="col">Gastos</th>
                            <th scope="col">total</th>
                            <th scope="col">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($userDates) :
                            $userDates = $user->userDates();

                            foreach ($userDates as $userDate) {
                                $total = 0;

                                $historic = $userDate->historic();

                                $date = new DateTime($userDate->date);

                                $appAccounts = $userDate->appsAccounts();

                                echo "<tr>";
                                echo "<td> " . $date->format('d-m-Y') . "</td> ";
                                foreach ($appAccounts as $appAccount) {
                                    echo "<td> " . $appAccount->money . "</td> ";
                                    $total += $appAccount->money;
                                }

                                $total += ($historic->money + $historic->expenses + $historic->balance);

                                echo "<td> " . $historic->money . "</td> ";
                                echo "<td> " . $historic->expenses . "</td> ";
                                echo "<td> " . $total . "</td> ";
                                echo "<td> " . $historic->balance . "</td> ";
                                echo "<tr>";
                            }

                        endif; ?>


                    </tbody>


                </table>

            </div>
        </div>
    </div>

    <?php $v->start('js'); ?>

    <script src="<?= url('themes/theme1/js/registerDay.js'); ?>"></script>

    <?php $v->end(); ?>


<?php else :
    $router->redirect('app.web.home');

endif ?>