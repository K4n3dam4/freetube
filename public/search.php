<!-- HEADER -->
<?php include "includes/header.php";?>

  <!-- MAIN -->
  <main class="mt-5 mb-5">


    <section class="featured">
      <?php
      $vid = new \videos\Video;
      $vid->returnSearch($_POST['search']);

      $count = count($vid->result);

      echo "<h3 class='text-center mb-3'>{$count} Results</h3>";  
      ?>


      <!-- CONTAINER -->
      <div class="container">

        <div class="row">

          <!--  VIDEO -->
          <?php

          foreach ($vid->result as $key => $data) {
            ?>
            <div class="featured-card col-lg-4 col-md-6">
              <div class="card">
                <div class="embed-responsive embed-responsive-16by9 card-img-top vid-feature">
                  <video src="assets/videos/<?php echo $data['vid_url']; ?>"></video>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-3 align-self-center justify-content-center">
                        <img class="d-block mx-auto" src="assets/images/channels/boiler-room.jpg" alt="" srcset="">
                      </div>
                      <div class="col-9 align-self-center justify-content-center">
                        <a class="text-primary col-lg-9 col-md-8 col-sm-8" href=""><h5 class="mb-0"><?php echo $data['vid_title']; ?></h5></a>
                      </div>
                      <div class="col-3"></div>
                      <div class="col-9">
                        <p class="meta">
                          <span class=""><span class="pr-2">by</span><a class="text-primary" href=""><?php echo $data['vid_uploader']; ?></a></span>
                        </p>
                      </div>
                      <div class="col-3"></div>
                      <div class="col-9">
                        <p class="meta">
                          <span><a class="text-primary" href=""><i class="fa fa-folder-o pr-2" aria-hidden="true"></i> <?php echo $data['vid_cat_id']; ?> </a></span>
                        </p>
                      </div>
                      <div class="col-3"></div>
                      <div class="col-9">
                        <p class="meta">
                          <span><i class="fa fa-calendar pr-2" aria-hidden="true"></i> <?php echo $data['vid_date']; ?> </span>
                          <span class="pl-3"><i class="fa fa-comments pr-2" aria-hidden="true"></i> <?php echo $data['vid_com_count']; ?> </span>
                          <span class="pl-3"><i class="fa fa-thumbs-up pr-2" aria-hidden="true"></i></i><?php echo $data['vid_like_count']; ?> </span>
                        </p>
                      </div>
                  </div>
                </div>
              </div>        
            </div>
          <?php
          } ?>
          <!-- VIDEO END -->

        </div>

      </div><!-- CONTAINER END -->
    </section>

  </main>
  <!-- </> MAIN END -->
    
<!-- FOOTER -->
<?php include "includes/footer.php"; ?>