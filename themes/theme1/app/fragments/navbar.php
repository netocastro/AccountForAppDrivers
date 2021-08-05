<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?= $router->route('app.web.home') ?>">AppGerence</a>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= $router->route('app.web.home') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= $router->route('app.web.register') ?>">Registrar-se</a>
                </li>
            </ul>
        </div>
    </div>

</nav><br>
