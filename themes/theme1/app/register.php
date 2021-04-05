<?php $v->layout('_template') ?>

<h1 class="text-light text-center">Register</h1>

<div style="display: flex; align-items: center; justify-content: center;">

    <form method="POST" action="<?= $router->route('app.request.register') ?>" id="form-register" class="text-light">
        <input type="email" placeholder="Digite email" name="email" class="form-control mb-2">
        <input type="text" placeholder="Digite cpf" name="cpf" maxlength="14" class="form-control mb-2">
        <input type="text" placeholder="Digite Nome" name="name" class="form-control mb-2">
        <input type="password" placeholder="Digite senha" name="password" class="form-control mb-2">
        <input type="password" placeholder="Repita senha" name="repeat_password" class="form-control mb-2">
        <div class="d-flex justify-content-center ">
            <input type="checkbox" name="apps[]" value="1" class="form-check-input ms-2">Uber
            <input type="checkbox" name="apps[]" value="2" class="form-check-input ms-2">99
            <input type="checkbox" name="apps[]" value="3" class="form-check-input ms-2">Cabify
            <input type="checkbox" name="apps[]" value="4" class="form-check-input ms-2">2v
            <input type="checkbox" name="apps[]" value="5" class="form-check-input ms-2">Extra
        </div>
        <br>
        <button type="submit" class="btn btn-info col-12">Enviar</button>
    </form>

</div>

<?php $v->start('js'); ?>

<script src="<?= url('themes/theme1/app/js/register.js'); ?>"></script>

<?php $v->end(); ?>