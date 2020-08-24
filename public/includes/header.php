<?php

declare(strict_types = 1);
ob_start();
session_start();
include "classes/autoloader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Freetube</title>
</head>
<body>

  <!-- HEADER -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <a href="index.php" class="navbar-brand">free<b class="text-primary">Tube</b></a>  		
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
              $cat = new \categories\Category();
              $cat->returnAll();
              foreach ($cat->result as $key => $data) {
                echo "<a class='dropdown-item' href='#'>{$data['cat_title']}</a>";
              }
              ?>
            </div>
          </li>
        </ul>
    
        <!-- SEARCH FORM -->
        <form class="navbar-form ml-auto mr-auto form-inline" action="search.php" method="post">
          <div class="input-group search-box">								
            <input type="text" name="search" id="search" class="form-control" placeholder="Search">
            <div class="input-group-append">
              <button name="submit" class="btn my-sm-0 btn-outline-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </form>
        <!-- </>SEARCH FORM -->
        
        <!-- LOGIN FORM -->
        <div class="navbar-nav action-buttons ml-auto mr-lg-3">
          <a href="#" data-toggle="dropdown" class="btn btn-outline-primary nav-item login-btn" aria-expanded="false">Login</a>
          <div class="dropdown-menu login-form dropdown-menu-right ">
            <form class="px-4 py-3" action="/examples/actions/confirmation.php" method="post">
              <div class="form-group">
                <label>Username:</label>
                <input type="text" class="form-control" required="required">
              </div>
              <div class="form-group">
                <div class="clearfix">
                  <label>Password:</label>
                  <a href="#" class="float-right text-muted"><small>Forgot Password?</small></a>
                </div>                            
                <input type="password" class="form-control" required="required">
              </div>
              <input type="submit" class="btn btn-primary btn-block" value="Submit">
            </form>					
          </div>
        </div>
        <!-- </>LOGIN FORM -->
          
        <!-- SIGN UP FORM -->
        <div class="navbar-nav action-buttons">
          <a href="#" data-toggle="dropdown" class="btn btn-primary signup-btn" aria-expanded="false">Sign Up</a>
          <div class="dropdown-menu login-form dropdown-menu-right ">
            <form class="signup px-4 py-3" action="login.php" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Channel Name" name="name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="First & Last Name" name="owner">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email Address" name="email">
              </div>
        
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="pwd">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirm Password" name="pwd_repeat">
              </div>
    
              <div class="form-group" id="terms-of">
                <div class="checkbox">
                  <label>
                    <input class="text-black-50" type="checkbox"><a class="text-muted" href="#"><small> Terms & Conditions</small></a>
                  </label>
                </div>
              </div>
              <input type="submit" class="btn btn-primary btn-block" value="Submit" name="signup">
            </form>
          </div>			
        </div>
        <!-- </>SIG NUP FORM -->
      </div>
    </nav>
  </header>
  <!--</> HEADER END-->