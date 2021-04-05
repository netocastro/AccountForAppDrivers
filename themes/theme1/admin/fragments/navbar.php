<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?= $router->route('app.web.home') ?>">AppGerence</a>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->route('admin.web.viewBalance') ?>">Balanço</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->route('admin.web.home') ?>">Registro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Configurações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->route('app.web.logout') ?>">Sair</a>
                </li>
            </ul>
        </div>
    </div>

</nav>
