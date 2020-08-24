<?php 
require APPROOT . '/views/includes/header.php';
?>

  <?php if (!isset($_SESSION['channel_id'])) : ?>
    <div id="landing">
      <div id="landing_img"></div>
      <div class="container h-100 d-flex align-items-center">
        <div class="row">
          <div class="col-md-6">
            <h1 class="landing-headline font-weight-bold text-primary w-25">
            We film the word
            </h1>
          </div>
          <div class="col-md align-self-end">
            <p class="text-white landing-paragraph text">
            Freetube is what youtube isn't, free! 
            There is no censorship of political opinions on freetube. 
            Join our members and start filming or scroll 
            down to explore the content of other channels
            </p>
          </div>
        </div>
      </div>
    </div>
  <?php endif ?>
    

  <!-- MAIN -->
  <main class="mt-5 mb-5">


    <section class="featured">
      <h2 class="text-center mb-5">Featured Videos</h2>

      <!-- CONTAINER -->
      <div class="container">

        <div class="row videos-ajax">

          <!-- VIDEO -->
          <!-- VIDEO END -->

        </div>

      </div><!-- CONTAINER END -->
    </section>

  </main>
  <!-- </> MAIN END -->

  <!-- SCRIPT -->
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
          url: '<?php echo URLROOT;?>/ajax/loadVideosMain',
          method: 'POST',
          datatype: 'video',
          data: {
            getData: 1,
            start: start,
            limit: limit
          },
          success: function(response) {
            start += limit;

            if (response != false) {
              $('.videos-ajax').append(response);
              playVideo()
            } else {
              playVideo()
              reachedMax = true;
            }
          }
        })
      }
    }
  </script>

<!-- FOOTER / SCRIPTS -->
<?php 
require APPROOT . '/views/includes/footer.php';
?>