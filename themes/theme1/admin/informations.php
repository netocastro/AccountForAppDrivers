<?php

$v->layout('_template'); ?>


<?php if ($infos) : ?>
    <div class="container mb-5">
        <?php krsort($infos); foreach ($infos as $ano => $meses) : ?>
            <div class="row">
                <div class="col-md-12">
                    <h4><?= $ano ?> </h4>
                    <hr class="mb-5">

                    <?php krsort($meses); foreach ($meses as $mes => $dias) : ?>
                        <div class="bg-success text-light text-center rounded">
                            <h4><?= month($mes);  ?> </h4>
                        </div>
                        <table class="table mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">Dia</th>

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
                                <?php ksort($dias); foreach ($dias as $dia => $values) : ?>
                                    <?php $total = 0; ?>

                                    <tr>
                                        <td><?= $dia . " / " . dayOfWeek((new DateTime("{$ano}-{$mes}-{$dia}"))->format('N')); ?></td>

                                        <?php foreach ($values['appsAccounts'] as $appsAccount) : ?>
                                            <td><?= number_format($appsAccount->money, 2, ',', '.'); ?></td>
                                            <?php $total += $appsAccount->money; ?>
                                        <?php endforeach; ?>

                                        <?php $total += ($values['historic']->money + $values['historic']->expenses + $values['historic']->balance); ?>

                                        <td><?= number_format($values['historic']->money, 2, ',', '.'); ?></td>
                                        <td><?= number_format($values['historic']->expenses, 2, ',', '.'); ?></td>
                                        <td><?= number_format($total, 2, ',', '.') ?></td>

                                        <td><?= number_format(($values['historic']->balance == 0 ? 0 : $values['historic']->balance * -1.00), 2, ',', '.') ?></td>

                                    <tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>

                    <?php endforeach; ?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

<?php else : ?>

    <div class="d-flex justify-content-center">
        <div class="p-5 mb-4 bg-light rounded-3">
            <h1 class="display-4">Você ainda não possui nenhum registro</h1>
            <div class="d-flex justify-content-center">
                <a href="<?= $router->route('admin.web.home') ?>">Registrar</a>
            </div>
        </div>

    </div>


<?php endif; ?>