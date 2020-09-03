<!-- HEADER -->
<?php 
require APPROOT . '/views/includes/header.php';
?>

<div class="view-video row">
  <!-- main video -->
  <div class="main-vid-wrapper col-md-8">

    <!-- video -->
    <div>
      <div class="main-video embed-responsive embed-responsive-16by9">
        <video controls src="<?php echo URLROOT . '/' . $data['main_vid']['vid_url']; ?>"></video>
      </div>
      <div class="row">
        <div class="col-md-8 col-sm-6">
          <h3 class=" text-dark my-4"><?php echo $data['main_vid']['vid_title']; ?></h3>
        </div>
        <div class="col-md-4 col-sm-6 d-flex align-items-center justify-content-end">
          <span><i class="fa fa-calendar pr-2" aria-hidden="true"></i> <?php echo $data['main_vid']['vid_date']; ?> </span>
          <?php if (isLoggedIn()) : ?>
            <form action="<?php echo (!$data['has_liked']) ? URLROOT . '/view/like' : URLROOT . '/view/unlike' ?>" method="post">
              <span class="pl-3 text-decoration-none text-dark">
                <i class="fa fa-comments pr-2 text-dark" aria-hidden="true"></i> <?php echo $data['main_vid']['vid_com_count']; ?>
              </span>
              <input type="hidden" name="like_vid_id" value="<?php echo $data['main_vid']['vid_id']; ?>">
              <button class="pl-3 bg-transparent border-0 text-decoration-none <?php echo ($data['has_liked']) ? 'text-primary' : 'text-dark'; ?>">
                <i class="fa fa-thumbs-up pr-2" aria-hidden="true"></i> <?php echo $data['main_vid']['vid_like_count']; ?>
              </button>
            </form>
          <?php else : ?>
            <span class="pl-3 text-decoration-none text-dark">
              <i class="fa fa-comments pr-2 text-dark" aria-hidden="true"></i> <?php echo $data['main_vid']['vid_com_count']; ?>
            </span>
            <a href="<?php echo URLROOT;?>/channels/login" class="pl-3 bg-transparent border-0 text-decoration-none text-dark">
              <i class="fa fa-thumbs-up pr-2" aria-hidden="true"></i> <?php echo $data['main_vid']['vid_like_count']; ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-5 d-flex align-items-center">
          <img class="d-block" src="<?php echo URLROOT . '/' . $data['main_vid']['channel_img']?>" alt="" srcset="">
          <p class="meta pl-3">
            <h5>
              <a class="text-primary" href="<?php echo URLROOT . '/videos/index/'. $data['main_vid']['channel_id']; ?>"><?php echo $data['main_vid']['channel_name']; ?>
              </a>
            </h5>
          </p>
        </div>
        <div class="col-7 d-flex align-items-center justify-content-end">
          <button class="btn btn-outline-dark">Follow</button>
        </div>
      </div>

      <hr>
    </div>
    <!-- </> video-->


    <!-- COMMENTS -->
    <div class="comments-wrapper">
      <div class="total-comments">
        <?php echo $data['main_vid']['vid_com_count']?> comments so far
      </div>
      <?php flash('comment_added'); ?>
      <?php flash('comment_not_added'); ?>
      <?php flash('comment_empty'); ?>
      <!-- Write Comment -->
      <?php if (isLoggedIn()) : ?>
        <form action="<?php echo URLROOT; ?>/view/comment" method="post" class="mt-4">
          <input type="hidden" name="com_vid_id" value="<?php echo $data['main_vid']['vid_id'];?>">
          <textarea class="comment" name="com_content" placeholder="Leave a comment"></textarea>
          <div class="comment-btns mt-2 d-flex justify-content-end">
            <button class="comment-btn comment-cancel btn btn-danger mr-3 d-none" type="button">Cancel</button>
            <button class="comment-btn comment-submit btn btn-info d-none" type="submit">Comment</button>
          </div>
        </form>
      <?php endif; ?>
      <!-- </> write comment -->

      <!-- All comments -->
      <div class="com-ajax">

      </div>
      <!-- </> all comments -->

    </div>
  <!-- </> comments -->

  </div>
  <!-- </>main video -->

  <!-- side videos -->
  <div class="side-videos col-md-4">
          
  </div>
  <!-- </>side videos -->


</div>

<!-- SCRIPT -->
<?php if (isLoggedIn()) : ?>
  <script src="<?php echo URLROOT; ?>/js/comment.js"></script>
<?php endif; ?>
<script>
    let start = 0;
    let limit = 10;
    let reachedMax = false;

    let startVid = 0;
    let limitVid = 10;
    let reachedMaxVid = false;

    $(document).ready(function() {
      getCom();
      getVid();
    })

    $(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
      getCom();
      getVid();
    }
    });

    function getCom() {

      if (reachedMax) {
        return;
      } else {
        $.ajax({
          url: '<?php echo URLROOT;?>/ajax/loadComments',
          method: 'POST',
          datatype: 'text',
          data: {
            getCom: 1,
            video: <?php echo $data['main_vid']['vid_id'];?>,
            start: start,
            limit: limit
          },
          success: function(response) {
            start += limit;

            if (response != false) {
              $('.com-ajax').append(response);
              <?php if (isLoggedIn()) :?>
                editComment();
              <?php endif; ?>
            } else {
              reachedMax = true;
            }
          }
        })
      }
    }

    function getVid() {
      if (reachedMaxVid) {
        return;
      } else {
        $.ajax({
          url: '<?php echo URLROOT;?>/ajax/loadVideosSide',
          method: 'POST',
          datatype: 'text',
          data: {
            getVid: 1,
            video: <?php echo $data['main_vid']['vid_id'];?>,
            start: startVid,
            limit: limitVid
          },
          success: function(response) {
            startVid += limitVid;

            if (response != false) {
              $('.side-videos').append(response);
              playVideo()
            } else {
              playVideo()
              reachedMaxVid = true;
            }
          }
        })
      }
    }


</script>

<!-- FOOTER / SCRIPTS -->
<script src="<?php echo URLROOT; ?>/js/playvideo.js"></script>