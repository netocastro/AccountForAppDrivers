<?php $session = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>

<?php if ($session) : ?>
  <!doctype html>
  <html lang="<?= LENGUAGE ?>">

  <head>
    <!-- Required meta tags -->
    <meta charset="<?= CHARACTER_ENCODING ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= url('cdn/libs/bootstrap/bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= url('themes/theme1/admin/css/style.css') ?>" rel="stylesheet">

    <title><?= $title ?></title>

  </head>

  <body>
    <?= $v->insert('fragments/navbar') ?>
    <?= $v->section('content') ?>
    <br><br><br><br><br>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= url('cdn/libs/bootstrap/bootstrap-5.0.0-beta1-dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= url('cdn/libs/jquery/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= url('cdn/assets/js/functions.js'); ?>"></script>
    <?= $v->section('js'); ?>

  </body>

  </html>

<?php else :
  $router->redirect('app.web.home');
endif ?>