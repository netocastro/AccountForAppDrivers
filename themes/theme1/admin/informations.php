<?php

$v->layout('_template'); ?>

<?php if ($infos) : ?>
    <div class="container mb-5">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php krsort($infos);
            foreach ($infos as $ano => $meses) : ?>
                <h4 class="ps-2 mt-4 mb-3 bg-primary text-light rounded"><?= $ano ?> </h4>

                <?php krsort($meses);
                foreach ($meses as $mes => $dias) : ?>

                    <div class="accordion-item text-center">
                        <h1 class="accordion-header text-center" id="flush-heading<?= month($mes) . $ano; ?>">
                            <button class="accordion-button collapsed  py-1 my-1 rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= month($mes) . $ano; ?>" aria-expanded="false" aria-controls="flush-collapse<?= ´pç - month($mes) . $ano; ?>">
                                <?= month($mes); ?>
                            </button>
                        </h1>
                        <div id="flush-collapse<?= month($mes) . $ano; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= month($mes) . $ano; ?>" data-bs-parent="#accordionFlushExample">
                            <table class="table table-sm table-responsive mb-3">
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
                                    <?php ksort($dias);
                                    foreach ($dias as $dia => $values) : ?>
                                        <?php $total = 0; ?>

                                        <tr class="table-<?= ((new DateTime("{$ano}-{$mes}-{$dia}"))->format('W') % 2 == 1 ? 'primary' : 'info') ?>">
                                            <td><?= $dia . " / " . dayOfWeek((new DateTime("{$ano}-{$mes}-{$dia}"))->format('N')); ?></td>

                                            <?php foreach ($values['appsAccounts'] as $appsAccount) : ?>
                                                <td><?= number_format($appsAccount->money, 2, ',', '.'); ?></td>
                                                <?php $total += $appsAccount->money; ?>
                                            <?php endforeach; ?>

                                            <?php $total += ($values['historic']->money + $values['historic']->expenses + $values['historic']->balance); ?>

                                            <td><?= number_format($values['historic']->money, 2, ',', '.'); ?></td>
                                            <td><?= number_format($values['historic']->expenses, 2, ',', '.'); ?></td>
                                            <td><?= number_format($total, 2, ',', '.'); ?></td>

                                            <td><?= number_format(($values['historic']->balance == 0 ? 0 : $values['historic']->balance * -1.00), 2, ',', '.'); ?></td>
                                        <tr>

                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
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