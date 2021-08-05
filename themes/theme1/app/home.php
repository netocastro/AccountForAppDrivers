<?php $v->layout('_template'); ?>



<div class="container mt-5">
	<div class="row mt-5">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form method="POST" id="form-login" action="<?= $router->route('app.request.login') ?>">
				<h1 class="text-center">Login</h1>
				<input type="email" placeholder="Email" class="form-control my-2" name="email">
				<input type="password" placeholder="Senha" class="form-control my-2" name="password">
				<div class="d-grid gap-2">
					<button type="submit" class="btn btn-primary my-2">Login</button>
				</div>
				<div class="d-none justify-content-center mt-2 load">
					<div class="spinner-border text-primary" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>

<?php $v->start('js'); ?>

<script>
	let rota = '<?= $router->route('admin.web.home') ?>';
</script>

<script src="<?= url('themes/theme1/app/js/login.js'); ?>"></script>

<?php $v->end(); ?>