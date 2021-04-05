<?php $v->layout('_template'); ?>

<div class="container mt-5">
	<div class="row mt-5">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form method="POST" id="form-login" action="<?= $router->route('app.request.login') ?>">
				<h1 class="text-center text-light">Login</h1>
				<input type="email" placeholder="Email" class="form-control my-2" name="email">
				<input type="password" placeholder="Senha" class="form-control my-2" name="password">
				<button type="submit" class="btn btn-primary col-12 my-2">Login</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>

<?php $v->start('js'); ?>

<script>
	let rota = '<?= $router->route('admin.web.home') ?>'
</script>

<script src="<?= url('themes/theme1/app/js/login.js'); ?>"></script>

<?php $v->end(); ?>