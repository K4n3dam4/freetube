function playVideo() {
  $(".vid-feature").hover(function () {
      $(this).children("video")[0].play();
  }, function () {
      var el = $(this).children("video")[0];
      el.pause();
      el.currentTime = 0;
  });
}