<?php 
require APPROOT . '/views/includes/admin_header.php';
?>  
  
  <!-- MAIN -->
  <div class="page-wrapper">

    <div class="container-fluid">

      <h1 class="page-header pb-4">
        <small>Welcome</small>
        Admin
      </h1>

      <div class="row">
        <div class="col-lg-3">
          <div class="card dashboard-card dahsboard-channel">
            <div class="card-body">
              <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-center">
                  <i class="fa fa-user dashboard-icon" aria-hidden="true"></i>
                </div>
                <div class="col-6">
                  <div class="d-flex justify-content-end align-items-center">
                    <h1 class=""><?= $data['channel_count'];?></h1>
                  </div>
                  <div class="d-flex justify-content-end align-items-center">
                    <b>Channels</b>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card dashboard-card dahsboard-category">
            <div class="card-body">
              <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-center">
                  <i class="fa fa-list dashboard-icon" aria-hidden="true"></i>
                </div>
                <div class="col-6">
                  <div class="d-flex justify-content-end align-items-center">
                    <h1 class=""><?= $data['cat_count'];?></h1>
                  </div>
                  <div class="d-flex justify-content-end align-items-center">
                    <b>Categories</b>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="card dashboard-card dahsboard-video">
            <div class="card-body">
              <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-center">
                  <i class="fa fa-video-camera dashboard-icon" aria-hidden="true"></i>
                </div>
                <div class="col-6">
                  <div class="d-flex justify-content-end align-items-center">
                    <h1 class=""><?= $data['vid_count'];?></h1>
                  </div>
                  <div class="d-flex justify-content-end align-items-center">
                    <b>Videos</b>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="card dashboard-card dahsboard-comment">
            <div class="card-body">
              <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-center">
                  <i class="fa fa-comment dashboard-icon" aria-hidden="true"></i>
                </div>
                <div class="col-6">
                  <div class="d-flex justify-content-end align-items-center">
                    <h1 class=""><?= $data['com_count'];?></h1>
                  </div>
                  <div class="d-flex justify-content-end align-items-center">
                    <b>Comments</b>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 mt-5">
          <?php require APPROOT . '/views/includes/admin_chart_all.php'?>
        </div>
        <div class="col-12 mt-4">
          <h3 class="text-center">Hottest Channels <small>(Most Likes)</small></h3>
          <?php require APPROOT . '/views/includes/admin_chart_best.php'?>
        </div>
      </div>

    </div>

  </div>

  <script>
    $(document).ready(function() {
      $('.dashboard-card').each(function(i) {
        let item = $(this);
        setTimeout(() => {
          item.animate({
            opacity: '1',
            top: '0px'
          }, 'fast');
        }, 220 * i);
      })
    })
  </script>


<?php
require APPROOT . '/views/includes/admin_footer.php';
?>