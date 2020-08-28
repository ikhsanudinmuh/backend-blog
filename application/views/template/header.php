<!doctype html>
<html lang="en">

<head>

  <link rel="icon" href="<?= base_url() ?>assets/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/datatable/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/mystyle.css">
  <script src="<?= base_url() ?>assets/js/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/datatable/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/datatable/js/dataTables.bootstrap4.min.js"></script>
  <script>
    var BASE_URL = '<?= base_url() ?>';
  </script>
  <script src="<?= base_url() ?>assets/js/myscript.js"></script>
  <title><?= $title ?></title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-orange">
    <a class="navbar-brand">
      <img src="<?= base_url() ?>assets/img/RPLGDC_logo.jpeg" width="35" height="35" alt="" loading="lazy">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>publication">PUBLICATION</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>course">COURSE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>about">ABOUT</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">

    <div class="row mt-4">

      <div class="col-md-9">