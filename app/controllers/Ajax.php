<?php 

class AJAX extends Controller {
  public function __construct() {
    $this->videoModel = $this->model('Video');
    $this->commentModel = $this->model('Comment');
  }

  public function loadVideosMain() {
    if (isset($_POST['getData'])) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $start = trim($_POST['start']);
      $limit = trim($_POST['limit']);

      $videos = $this->videoModel->getVideosAjax($start, $limit);  

      $data = [
        'videos' => $videos
      ];

      if ($videos != false) {
        $this->view('includes/video_cards', $data);
      } else {
        echo $videos;
      }

    }
  }

  public function loadVideosSide() {
    if (isset($_POST['getVid'])) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $vid_id = trim($_POST['video']);
      $start = trim($_POST['start']);
      $limit = trim($_POST['limit']);

      $videos = $this->videoModel->getVideosAjax($start, $limit);  

      $data = [
        'vid_id' => $vid_id,
        'videos' => $videos
      ];

      if ($videos != false) {
        $this->view('includes/video_side', $data);
      } else {
        echo $videos;
      }

    }
  }

  public function searchVideos() {
    if (isset($_POST['getData'])) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $start = trim($_POST['start']);
      $limit = trim($_POST['limit']);
      $search = trim($_POST['keyword']);

      $videos = $this->videoModel->searchVideosAjax($limit, $start, $search);

      $data = [
        'videos' => $videos
      ];

      if ($videos != false) {
        $this->view('includes/video_cards', $data);
      } else {
        $videos;
      }

    }
  }

  public function searchCategory() {
    if (isset($_POST['getData'])) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $start = trim($_POST['start']);
      $limit = trim($_POST['limit']);
      $search = trim($_POST['keyword']);

      $videos = $this->videoModel->searchCatVidAjax($limit, $start, $search);

      $data = [
        'videos' => $videos
      ];

      if ($videos != false) {
        $this->view('includes/video_cards', $data);
      } else {
        $videos;
      }

    }
  }

  public function loadComments() {
    if (isset($_POST['getCom'])) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $start = trim($_POST['start']);
      $limit = trim($_POST['limit']);
      $vid_id = trim($_POST['video']);

      $comments = $this->commentModel->getCommentsAjax($start, $limit, $vid_id);

      $data = [
        'comments' => $comments
      ];

      if ($comments != false) {
        $this->view('includes/comments', $data);
      } else {
        $comments;
      }

    }
  }
}


?>