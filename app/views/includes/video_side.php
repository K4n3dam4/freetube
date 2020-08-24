<?php foreach ($data['videos'] as $key => $video) : ?>
  <?php if ($data['vid_id'] != $video['vid_id']) : ?>
  <div class="row">
    <div class="col-7">
      <div class="embed-responsive embed-responsive-16by9 card-img-top vid-feature">
        <video src="<?php echo URLROOT; ?>/<?php echo $video['vid_url']; ?>"></video>
      </div>
    </div>
    <div class="col-5">
      <div class="row d-flex">
        <div class="col-12 py-2">
          <a class="text-primary font-weight-bold" href="<?php echo URLROOT; ?>/view/video/<?php echo $video['vid_id']; ?>"><?php echo $video['vid_title']; ?></a>
        </div>
        <div class="col-9 d-flex flex-column">
          <span class="side-video-channel py-2">
            <a class="text-primary" href="<?php echo URLROOT; ?>/videos/index/<?php echo $video['channel_id']; ?>"><?php echo $video['channel_name']; ?>
            </a>
          </span>
          <span class="small">
            <i class="fa fa-calendar pr-2 py-2" aria-hidden="true"></i>
            <?php echo $video['vid_date']; ?>
          </span>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <?php endif; ?>
<?php endforeach; ?>