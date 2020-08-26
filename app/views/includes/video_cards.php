  <?php foreach ($data['videos'] as $key => $video) : ?>
    <div class="featured-card col-lg-4 col-md-6 d-flex align-items-stretch">
      <div class="card manage-video">
        <div class="embed-responsive embed-responsive-16by9 card-img-top vid-feature">
          <video muted src="<?php echo URLROOT . '/' .$video['vid_url']; ?>"></video>
        </div>
        <div class="card-body d-flex align-content-center">
          <div class="row">
            <div class="col-3 mt-4">
              <img class="d-block mx-auto" src="<?php echo URLROOT . '/' .$video['channel_img']?>" alt="" srcset="">
            </div>
            <div class="col-9 my-auto">
              <a class="text-primary col-lg-9 col-md-8 col-sm-8 h-20" href="<?php echo URLROOT . '/view/video/' .$video['vid_id']; ?>"><h5 class="mb-0"><?php echo $video['vid_title']; ?></h5></a>
            </div>
            <div class="col-3 py-auto my-auto"></div>
            <div class="col-9 py-auto my-auto">
              <p class="meta">
                <span class=""><span class="pr-2">by</span><a class="text-primary" href="<?php echo URLROOT . '/videos/index/' . $video['channel_id'];?>"><?php echo $video['channel_name'];?></a></span>
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