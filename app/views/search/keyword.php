<?php 
require APPROOT . '/views/includes/header.php';
?>


  <!-- MAIN -->
  <main class="mt-5 mb-5">


    <section class="featured">
      <!-- CONTAINER -->
      <div class="container">

        <div class="row search-ajax">

          <!-- VIDEO -->
          <!-- VIDEO END -->

        </div>

      </div><!-- CONTAINER END -->
    </section>

  </main>
  <!-- </> MAIN END -->


  <!-- SCRIPT AJAX -->
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
          url: '<?php echo URLROOT;?>/ajax/searchVideos',
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


<?php 
require APPROOT . '/views/includes/footer.php';
?>