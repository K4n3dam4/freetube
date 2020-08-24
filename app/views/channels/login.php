<?php 
require APPROOT . '/views/includes/header.php';
?>

<div id="signup-container">
  <div class="card signup vh-100 vw-100">
    <article class="card-body mx-auto mt-5 pt-5" style="max-width: 400px;">
      <?php flash('register_success'); ?>
      <h2 class="card-title mt-3 text-center text-primary m-5">Login</h2>
      <form class="px-2" action="<?php echo URLROOT; ?>/channels/login" method="POST">

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
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
          </div>
          <input name="pwd" class="form-control <?php echo (!empty(
          $data['pwd_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pwd']; ?>" placeholder="Password" type="password">
          <span class="invalid-feedback"><?php echo $data['pwd_error']; ?></span>
        </div> <!-- password// -->

        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Login</button>                                                            
        </div> <!-- submit// -->  
        <p class="text-center text-light"><a href="#">Forgot your password?</a></p>
      </form>
    </article>
  </div> <!-- card.// -->

  </div> 
  <!--container end.//-->

</div>



<?php 
require APPROOT . '/views/includes/footer.php';
?>