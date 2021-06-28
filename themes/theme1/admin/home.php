<?php

$session = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if ($session) : ?>
    <?php $v->layout('_template'); ?>

    <h1 class="text-center">Cadastrar dia</h1>

    <div class=" d-flex justify-content-center">

        <form method="POST" action="<?= $router->route('admin.request.registerDay') ?>" id="form-registerDay">
            Data:<input type="date" name="date" class="form-control">

            <?php foreach ($userApps as $userApp) : ?>
                <?= $userApp->appName() ?>:<input type="number" name="<?= $userApp->appName(); ?>" step="0.01" class="form-control">
            <?php endforeach; ?>

            Dinheiro: <input type="number" name="money" step="0.01" class="form-control">
            Gastos: <input type="number" name="expenses" step="0.01" class="form-control">
            Total: <input type="number" name="total" step="0.01" class="form-control">
            <button type="submit" class="btn btn-primary btn-block mt-3">Salvar</button>

        </form>

    </div>

    <?php $v->start('js'); ?>

    <script src="<?= url('themes/theme1/admin/js/registerDay.js'); ?>"></script>

    <?php $v->end(); ?>


<?php else :
    $router->redirect('app.web.home');

endif ?>



<?php
