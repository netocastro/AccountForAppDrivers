<!doctype html>
<html lang="<?= LENGUAGE ?>">

<head>
  <!-- Required meta tags -->
  <meta charset="<?= CHARACTER_ENCODING ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="<?= url('cdn/libs/bootstrap/bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

  <link href="<?= url('themes/theme1/app/css/style.css') ?>" rel="stylesheet">

  <title><?= $title ?></title>
</head>

<body>

  <?= $v->insert('fragments/navbar') ?>
  <?= $v->section('content') ?>
  <?= $v->insert('fragments/footer') ?>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="<?= url('cdn/libs/bootstrap/bootstrap-5.0.0-beta1-dist/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= url('cdn/libs/jquery/jquery-3.5.1.min.js'); ?>"></script>
  <script src="<?= url('cdn/assets/js/functions.js'); ?>"></script>

  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

  <?= $v->section('js'); ?>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>