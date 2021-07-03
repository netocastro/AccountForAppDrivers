<?php $v->layout('_template'); ?>

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
                        foreach ($userDates as $userDate) :

                            $total = 0;

                            $historic = $userDate->historic();

                            $date = new DateTime($userDate->date);

                            $appAccounts = $userDate->appsAccounts();

                            echo "<tr>";
                            echo "<td> " . $date->format('d-m-Y') . "</td> ";

                            foreach ($appAccounts as $appAccount) :

                                echo "<td>R$ " .  number_format($appAccount->money, 2, ',', '.') . "</td> ";
                                $total += $appAccount->money;

                            endforeach;

                            $total += ($historic->money + $historic->expenses + $historic->balance);

                            echo "<td>R$ " . number_format($historic->money, 2, ',', '.') . "</td> ";
                            echo "<td>R$ " . number_format($historic->expenses, 2, ',', '.') . "</td> ";
                            echo "<td>R$ " . number_format($total, 2, ',', '.') . "</td> ";
                            echo "<td>R$ " . number_format(($historic->balance == 0 ? 0 : $historic->balance * -1.00), 2, ',', '.')  . "</td> ";
                            echo "<tr>";

                        endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
