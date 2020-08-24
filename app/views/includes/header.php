<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/node_modules/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/main.css">
  <script src="<?php echo URLROOT; ?>/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo URLROOT; ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <title><?php echo SITENAME; ?></title>
</head>
<body>

  <!-- HEADER -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <a href="<?php URLROOT; ?>/freetube/index" class="navbar-brand">free<b class="text-primary">Tube</b></a>  		
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Collection of nav links, forms, and other content for toggling -->
      <div id="navbarCollapse" class="navbar-collapse justify-content-start collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
              foreach ($data['categories'] as $key => $cat) {
                echo "<a class='dropdown-item' href='#'>{$cat['cat_title']}</a>";
              }
            ?>
            </div>
          </li>

          <li class="navbar-nav">
            <a class="nav-link" href="">Top Channels</a>
          </li>

          <li class="navbar-nav">
            <a class="nav-link" href="">About</a>
          </li>
        </ul>
    
        <!-- SEARCH FORM -->
        <form class="navbar-form form-inline px-lg-4 pb-lg-0 pb-md-4" action="<?php echo URLROOT; ?>/search/keyword" method="post">
          <div class="input-group search-box">								
            <input type="text" name="search" id="search" class="form-control" placeholder="Search">
            <div class="input-group-append">
              <button name="submit" class="btn my-sm-0 btn-outline-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </form>
        <!-- </>SEARCH FORM -->
        
        <?php if (isLoggedIn()) : ?>
          <!-- CHANNEL -->
          <div class="navbar-nav action-buttons">
            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-video-camera mr-2" aria-hidden="true"></i>
              <?php echo $_SESSION['channel_name'];?>
            </button>
            <div class="dropdown-menu dropdown-menu-md-right profile-dropdown">
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/videos/index/<?php echo $_SESSION['channel_id']; ?>"><i class="fa fa-play mr-3 my-1" aria-hidden="true mr-2"></i>Videos</a>
              <?php if (isAdmin()) : ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/admin/dashboard"><i class="fa fa-cog mr-3 my-1" aria-hidden="true"></i>Admin</a>
              <?php endif ;?>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/channels/profile"><i class="fa fa-user mr-3 my-1" aria-hidden="true"></i>Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/channels/logout"><i class="fa fa-sign-out mr-3 my-1" aria-hidden="true"></i>Logout</a>
            </div>
          </div>
          <!-- </> CHANNEL -->
        <?php else : ;?>
          <!-- LOGIN FORM-->
          <div class="navbar-nav action-buttons mr-lg-3">
            <a href="<?php echo URLROOT; ?>/channels/login" class="btn btn-outline-primary nav-item login-btn" aria-expanded="false">Login</a>
          </div>
          <!-- </>LOGIN FORM -->
            
          <!-- SIGN UP FORM -->
          <div class="navbar-nav action-buttons">
            <a href="<?php echo URLROOT; ?>/channels/signup" class="btn btn-primary signup-btn" aria-expanded="false">Sign Up</a>
          <!-- </>SIG NUP FORM -->
        </div> 
      <?php endif; ?>
    </nav>
  </header>
  <!--</> HEADER END-->