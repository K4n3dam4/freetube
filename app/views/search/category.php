<?php 
require APPROOT . '/views/includes/header.php';
?>


  <!-- MAIN -->
  <main class="mt-5 mb-5">


    <section class="featured">
      <!-- CONTAINER -->
      <div class="container">
          <!-- videos empty -->
          <?php if ($data['videos_empty'] == true) : ?>
            <div class="d-flex justify-content-center align-items-center flex-column my-5">
              <img class="w-50 h-50" src="<?= URLROOT;?>/assets/images/site/not_found.svg" alt="">
            </div>
          <?php endif; ?>

        <div class="row search-ajax">

          <!-- VIDEO -->
          <!-- VIDEO END -->
        </div>

      </div><!-- CONTAINER END -->
    </section>

  </main>
  <!-- </> MAIN END -->


  <!-- SCRIPT AJAX -->
  <?php if ($data['videos_empty'] == false) : ?>
    <script>
      let start = 0;
      let limit = 6;
      let reachedMax = false;

      $(document).ready(function() {
        getData();
      })

      $(window).scroll(function() {
      if($(window).scrollTop() == $(document).height() - $(window).height()) {
        getData();
      }
      });

      function getData() {
        if (reachedMax) {
          return;
        } else {
          $.ajax({
            url: '<?php echo URLROOT;?>/ajax/searchCategory',
            method: 'POST',
            datatype: 'video',
            data: {
              getData: 1,
              keyword: '<?php echo $data['search'];?>',
              start: start,
              limit: limit
            },
            success: function(response) {
              start += limit;

              if (response != false) {
                $('.search-ajax').append(response);
              } else {
                reachedMax = true;
              }
            }
          })
        }
      }
    </script>
  <?php endif ?>


<?php 
require APPROOT . '/views/includes/footer.php';
?>