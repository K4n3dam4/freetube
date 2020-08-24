<?php 
require APPROOT . '/views/includes/header.php';
?>

<div id="signup-container">
  <div class="card signup vh-100 vw-100">
    <article class="card-body mx-auto mt-5 pt-5" style="max-width: 400px;">
      <?php flash('register_danger')?>
      <h2 class="card-title mt-3 text-center text-primary m-5">Create Account</h2>
      <form class="px-2" action="<?php echo URLROOT; ?>/channels/signup" method="POST">

        <!-- channel name -->
        <div class="form-group input-group mt-4">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-video-camera" aria-hidden="true"></i> </span>
          </div>
          <input name="name" class="form-control <?php echo (!empty(
          $data['name_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['name']; ?>" placeholder="Channel name" type="text">
          <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
        </div> <!-- channel name// -->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
          </div>
          <input name="email" class="form-control <?php echo (!empty(
          $data['email_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']; ?>" placeholder="Email address" type="email">
          <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
        </div> <!-- channel email// -->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
          </div>
          <input name="owner" class="form-control <?php echo (!empty(
          $data['owner_error'])) ? 'is-invalid' : '';?>" value="<?php echo $data['owner']; ?>" placeholder="First & Last name" type="text">
          <span class="invalid-feedback"><?php echo $data['owner_error']; ?></span>
        </div> <!-- channel owner// -->

        <div class="form-group input-group">
        </div> <!-- divide// -->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
          </div>
          <input name="pwd" class="form-control <?php echo (!empty(
          $data['pwd_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pwd']; ?>" placeholder="Create password" type="password">
          <span class="invalid-feedback"><?php echo $data['pwd_error']; ?></span>
        </div> <!-- password// -->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
          </div>
          <input name="pwd_rpt" class="form-control <?php echo (!empty(
          $data['pwd_rpt_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pwd_rpt']; ?>" placeholder="Repeat password" type="password">
          <span class="invalid-feedback"><?php echo $data['pwd_rpt_error']; ?></span>
        </div> <!-- password repeat// -->

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
        </div> <!-- submit// -->      
        <p class="text-center text-light">Have an account? <a href="<?php echo URLROOT; ?>/users/login">Log In</a> </p>                                                                 
      </form>
    </article>
  </div> <!-- card.// -->

  </div> 
  <!--container end.//-->

</div>


<?php 
require APPROOT . '/views/includes/footer.php';
?>