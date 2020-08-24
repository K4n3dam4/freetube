<?php 
require APPROOT . '/views/includes/header.php';
?>

<div class="edit-profile-wrapper container py-2">
    <form role="form" enctype="multipart/form-data" action="<?php echo URLROOT;?>/channels/edit" method="POST" class="row">
        <!-- edit form column -->
        <div class="col-lg-4">
            <h2 class="text-center font-weight-light mb-4">User Profile</h2>
        </div>
        <div class="col-lg-8">
          <?php flash('profile_updated')?>
          <?php flash('profile_error')?>
        </div>
        <div class="col-lg-8 order-1 personal-info">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Channel name</label>
                    <div class="col-lg-9">
                        <input class="form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : '';?>" type="text" name="name" value="<?php echo $data['name']; ?>" />
                        <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Name</label>
                    <div class="col-lg-9">
                        <input class="form-control <?php echo (!empty($data['owner_error'])) ? 'is-invalid' : '';?>" type="text" name="owner" value="<?php echo $data['owner']; ?>" />
                        <span class="invalid-feedback"><?php echo $data['owner_error']; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                    <div class="col-lg-9">
                        <input class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '';?>" type="email" name="email" value="<?php echo $data['email']; ?>" />
                        <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Password</label>
                    <div class="col-lg-9">
                        <input class="form-control <?php echo (!empty($data['pwd_error'])) ? 'is-invalid' : '';?>" type="password" name="pwd" value="<?php echo $data['pwd']; ?>" />
                        <span class="invalid-feedback"><?php echo $data['pwd_error']; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                    <div class="col-lg-9">
                        <input class="form-control <?php echo (!empty($data['pwd_rpt_error'])) ? 'is-invalid' : '';?>" type="password" name="pwd_rpt" value="<?php echo $data['pwd_rpt']; ?>" />
                        <span class="invalid-feedback"><?php echo $data['pwd_rpt_error']; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-9 ml-auto text-right">
                        <input type="submit" class="btn btn-primary" value="Save Changes" />
                    </div>
                </div>
        </div>
        <div class="col-lg-4 order-0 text-center">
            <img src="<?php echo URLROOT?>/<?php echo $_SESSION['channel_img']; ?>" class="mx-auto img-fluid rounded-circle" alt="avatar" />
            <h6 class="my-4">Upload a new photo</h6>
            <div class="input-group px-xl-4">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02" name="img">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon01"></label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-primary"><i class="fa fa-upload"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="<?php echo URLROOT; ?>/js/file_upload.js"></script>


<?php 
require APPROOT . '/views/includes/footer.php';
?>