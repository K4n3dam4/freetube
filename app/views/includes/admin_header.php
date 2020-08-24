<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- FONTS -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- PLUGINS CSS -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/node_modules/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/main.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/second.css">

  <!-- PLUGINS -->
  <script src="<?php echo URLROOT; ?>/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo URLROOT; ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
  <title>Freetube</title>
</head>
<body>

  <!-- NAV -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <a href="<?php echo URLROOT; ?>" class="navbar-brand">free<b class="text-primary">Tube</b></a>
      <span class=" text-capitalize font-weight-bold text-white">Admin Panel</span>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- SIDE NAV -->
      <div id="navbarCollapse" class="navbar-collapse collapse side-nav h-100">
        <ul class="nav flex-column w-100">
          <li class="nav-item">
            <a class="nav-link active text-white" href="<?php echo URLROOT; ?>/admin/dashboard"><i class="fa fa-fw fa-dashboard pr-4"></i>Dashboard</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo URLROOT; ?>/admin/videos"><i class="fa fa-video-camera pr-2" aria-hidden="true"></i>Videos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo URLROOT; ?>/admin/channels"><i class="fa fa-user pr-2" aria-hidden="true"></i> Channels</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo URLROOT; ?>/admin/comments"><i class="fa fa-comments pr-2" aria-hidden="true"></i>Comments</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active text-white" href="<?php echo URLROOT; ?>/admin/categories"><i class="fa fa-list pr-2" aria-hidden="true"></i>Categories</a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!--</> NAV END-->