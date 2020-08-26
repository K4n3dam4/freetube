<?php 
require APPROOT . '/views/includes/header.php';
?>
<!-- CHANNEL WRAPPER -->
<div class="channel-wrapper">
  <div class="channel-nav text-light">

    <div class="container">
      <div class="row align-items-center pt-4">
        <div class="col-lg-6 d-flex align-items-center">
          <img class="d-block img-fluid mr-5" src="<?php echo URLROOT . '/' .$data['channel_img']?>" alt="" srcset="">
          <h3><?php echo $data['channel_name'];?></h3>
        </div>
        <div class="col-lg-6 d-flex align-items-center justify-content-end">
          <?php if ($data['is_channel'] == true) : ?>
            <button type="button" id="chnnael-upload" class="upload channel-menu action-buttons btn btn-primary mr-3">Upload</button>
            <button type="button" id="channel-manage" class="channel-menu action-buttons btn btn-primary mr-3">Manage</button>
            <!-- SEARCH CHANNEL -->
            <button id="close-channel-search" class="text-danger d-none"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
            <form id="search-channel-form" class="form-inline" action="<?php echo URLROOT; ?>/videos/keyword" method="post">
              <div class="input-group search-box">								
                <input type="text" name="channel-search" id="search-channel-input" class="form-control" placeholder="Search">
                <div class="input-group-append">
                  <button name="channel-search-submit" id="search-channel-submit" class="search-channel btn btn-outline-primary d-none" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
              </div>
            </form>
            <button id="open-channel-search" class="search-channel btn btn-outline-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
            <!-- </> SEARCH CHANNEL -->
          <?php endif?>
        </div>
      </div>
    </div>
  </div>

    <!-- Add VIDEO Form -->
    <?php if ($data['is_channel'] == true) : ?>
      <div class="channel-upload-form pb-5 pb-5">
        <div class="row pt-5">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            <h3 class="text-center mb-3">Upload video</h3>
            <form class="px-5" action="<?php echo URLROOT; ?>/videos/add" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="vid_title">Title</label>
                <input type="text" name="vid_title" class="form-control <?php echo (!empty($data['vid_title_error'])) 
                ? 'is-invalid' : ''; ?>" value="<?php echo $data['vid_title']; ?>">
                <span class="invalid-feedback"><?php echo $data['vid_title_error']; ?></span>
              </div>
              <div class="form-group">
                <label for="vid_cat_id">Category</label>
                <select name="vid_cat_id" class="form-control <?php echo (!empty($data['vid_cat_id_error'])) 
                ? 'is-invalid' : ''; ?>">
                    <option value="none-selected">Choose category</option>
                  <?php foreach ($data['categories'] as $key => $cat) : ?>
                    <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="invalid-feedback"><?php echo $data['vid_cat_id_error']; ?></span>
              </div>
              <div class="form-group">
                <label for="vid_tags">Tags</label>
                <input type="text" name="vid_tags" class="form-control <?php echo (!empty($data['vid_tags_error'])) 
                ? 'is-invalid' : ''; ?>" value="<?php echo $data['vid_tags'];?>">
                <span class="invalid-feedback"><?php echo $data['vid_tags_error']; ?></span>
              </div>
              <div class="form-group">
                <label for="vid_upload">Video</label>
                <br>
                <input class="bg-trans <?php echo (!empty($data['vid_upload_error'])) 
                ? 'is-invalid' : ''; ?>" type="file" name="vid_upload" class="form-control" value="Select video">
                <span class="invalid-feedback"><?php echo $data['vid_upload_error']; ?></span>
              </div>
              <div class="d-flex justify-content-center">
                <input type="submit" value="Submit" class="btn btn-primary">
              </div>
            </form>
          </div>
          <div class="col-md-4"></div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  

  <!-- MAIN -->
  <main class="mb-5 pb-5">

    <section class="featured">
      <!-- CONTAINER -->
      <div class="container">
        <div class="text-center">
          <?php flash('video_uploaded'); ?>
          <?php flash('video_not_added'); ?>
          <?php flash('video_deleted'); ?>
          <?php flash('video_not_deleted'); ?>
          <?php flash('video_edited'); ?>
          <?php flash('video_not_edited'); ?>
        </div>
        <div class="row">

          <!-- VIDEO -->
          <?php if (empty($data['videos'])) : ?>
            <!-- no video uploaded yet -->
            <div id="channel-no-video" class="mx-auto mt-5 d-flex flex-column justify-content-center align-content-center">
              <?php flash('video_no_result'); ?>
              <div id="no-video-svg" class="mx-auto mb-3"></div>
              <h3 class="text-center">Start now and upload a video</h3>
              <p class="text-center p-2 mx-2">Share your story and interact with your viewers. Your videos will be displayed here.</p>
              <button type="button" id="channel-upload-2" class="upload btn btn-outline-info">Upload Video</button>
            </div>
          <?php else : ?>
            <!-- show channel videos -->
            <?php foreach ($data['videos'] as $key => $video) : ?>
              <div class="featured-card col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="card">
                  <button class="toggle-edit btn btn-outline-primary d-none" data-index="<?php echo $video['vid_id']; ?>">Edit</button>
                  <div class="channel-edit-form py-4" data-index="<?php echo $video['vid_id']; ?>">
                    <h4 class="text-center mt-4 mb-2">Edit video</h4>
                    <?php if ($data['is_channel'] == true) : ?>
                      <form class="px-5 pt-4" action="<?php echo URLROOT; ?>/videos/edit" method="post">
                        <input type="hidden" name="vid_id" value="<?php echo $video['vid_id']; ?>">
                        <div class="form-group">
                          <label for="edit_title">Title</label>
                          <input type="text" name="edit_title" class="form-control <?php echo (!empty($data['edit_title_error'])) 
                          ? 'is-invalid' : ''; ?>" value="<?php echo $video['vid_title']; ?>">
                          <span class="invalid-feedback"><?php echo $data['edit_title_error']; ?></span>
                        </div>
                        <div class="form-group">
                          <label for="edit_cat_id">Category</label>
                          <select name="edit_cat_id" class="form-control">
                            <!-- first select is vid_cat_id -->
                            <?php foreach($data['categories'] as $key => $cat) :?>
                              <?php if ($video['cat_id'] == $cat['cat_id']) : ?>
                                <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach ($data['categories'] as $key => $cat) : ?>
                              <?php if ($video['cat_id'] != $cat['cat_id']) : ?>
                                <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="edit_tags">Tags</label>
                          <input type="text" name="edit_tags" class="form-control <?php echo (!empty($data['edit_tags_error'])) 
                          ? 'is-invalid' : ''; ?>" value="<?php echo $video['vid_tags'];?>">
                          <span class="invalid-feedback"><?php echo $data['edit_tags_error']; ?></span>
                        </div>
                        <div class="d-flex justify-content-center">
                          <input type="submit" value="Submit" class="btn btn-primary mt-3">
                        </div>
                      </form>
                    <?php endif; ?>
                  </div>
                  
                  <?php if ($data['is_channel'] == true) : ?>
                    <form action="<?php echo URLROOT; ?>/videos/delete" method="post">
                      <input type="hidden" name="del_vid" value="<?php echo $video['vid_id']; ?>">
                      <button type="submit" class="delete-video text-danger d-none"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </form>
                  <?php endif; ?>

                  <div class="embed-responsive embed-responsive-16by9 card-img-top vid-feature">
                    <video muted src="<?php echo URLROOT; ?>/<?php echo $video['vid_url']; ?>"></video>
                  </div>

                  <div class="card-body d-flex align-content-center">
                    <div class="row">
                      <div class="col-3 mt-4">
                        <img class="d-block mx-auto" src="<?php echo URLROOT; ?>/<?php echo $video['channel_img']?>" alt="" srcset="">
                      </div>
                      <div class="col-9 my-auto">
                        <a class="text-primary col-lg-9 col-md-8 col-sm-8 h-20" href="<?php echo URLROOT; ?>/view/video/<?php echo $video['vid_id']; ?>"><h5 class="mb-0"><?php echo $video['vid_title']; ?></h5></a>
                      </div>
                      <div class="col-3 py-auto my-auto"></div>
                      <div class="col-9 py-auto my-auto">
                        <p class="meta">
                          <span class=""><span class="pr-2">by</span><a class="text-primary" href=""><?php echo $video['channel_name']; ?></a></span>
                        </p>
                        <p class="meta">
                          <span><a class="text-primary" href=""><i class="fa fa-folder-o pr-2" aria-hidden="true"></i> <?php echo $video['cat_title']; ?> </a></span>
                        </p>
                        <p class="meta">
                          <span><i class="fa fa-calendar pr-2" aria-hidden="true"></i> <?php echo $video['vid_date']; ?> </span>
                          <span class="pl-3"><i class="fa fa-comments pr-2" aria-hidden="true"></i> <?php echo $video['vid_com_count']; ?> </span>
                          <span class="pl-3"><i class="fa fa-thumbs-up pr-2" aria-hidden="true"></i></i><?php echo $video['vid_like_count']; ?> </span>
                        </p>
                      </div>
                    </div>
                  </div>

                </div>        
              </div>
            <?php endforeach; ?>

          <?php endif; ?>
          <!-- VIDEO END -->

        </div>

      </div>
      <!-- CONTAINER END -->
    </section>

  </main>
  <!-- </> MAIN END -->
  
</div>

<!-- SCRIPT CHANNEL -->
<?php if ($data['is_channel'] == true) : ?>
  <script src="<?php echo URLROOT; ?>/js/channel_controls.js"></script>
  <?php if ($data['video_added'] == true) : ?>
    <script>
      channelUpload.innerHTML = "Close";
      channelBody.classList.toggle('overflow-hidden');
      uploadForm.classList.toggle('animateUpload');
    </script>
  <?php endif; ?>
  <?php if ($data['video_edited'] == true) : ?>
    <script>
      deleteVideo.forEach(element => {
        element.classList.toggle('d-none');
      });
      toggleEdit.forEach(element => {
        element.classList.toggle('d-none');
      })
      channelManage.innerHTML = 'Close';
      isOpenManage = true;

      editForm.forEach(element => {
        if (element.getAttribute('data-index') == <?php echo $data['vid_id']; ?>) {
          element.classList.toggle('animateEdit');
        }
      });

      toggleEdit.forEach(element => {
        if (element.getAttribute('data-index') == <?php echo $data['vid_id']; ?>) {
          element.innerHTML = 'Close';
        }
      });
    </script>
  <?php endif; ?>
<?php endif; ?>

<script src="<?php echo URLROOT; ?>/js/playvideo.js"></script>

</body>
</html>
