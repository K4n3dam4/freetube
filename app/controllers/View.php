<?php 
// ============= VIEW VIDEOS CONTROLLER ================


class View extends Controller {
  private $loggedIn = false;

  public function __construct() {
    $this->videoModel = $this->model('Video');
    $this->categoryModel = $this->model('Category');
    $this->commentModel = $this->model('Comment');
    $this->likeModel = $this->model('Like');
  }

  public function index() {
    
  }

  public function video($vid_id = null) {
    if ($vid_id == null) {
      redirect('index');
    } else {
      $main_vid = $this->videoModel->getVideo($vid_id);
      $videos = $this->videoModel->getVideos();
      $categories = $this->categoryModel->getCategories();
      // $comments = $this->commentModel->getComments($vid_id);
  
      $data = [
        // main video
        'main_vid' => $main_vid,
  
        // side videos
        'videos' => $videos,
  
        // categories
        'categories' => $categories,
  
        // // comments 
        // 'comments' => $comments,

        // has liked
        'has_liked' => false
      ];

      // check likes if logged in
      if (isLoggedIn()) {
        $data['has_liked'] = $this->likeModel->checkLiked($data, $_SESSION['channel_id']);
      }
  
      $this->view('view/video', $data);
    }

  }

  public function like() {
    $vid_id;

    if (!isset($_POST['like_vid_id'])) {
      redirect('index');
    } else {

      $vid_id = trim($_POST['like_vid_id']);

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // sanitize 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          // video id
          'like_vid_id' => $vid_id,

          // channel id
          'like_channel_id' => $_SESSION['channel_id']
        ];

        // add like
        $this->likeModel->addLike($data);

        // update com count
        $this->videoModel->updateLikes($vid_id, 'add');

        redirect('view/video/' . $vid_id);

      } else {
        $this->video($vid_id);
      }
    }
  }

  public function unlike() {
    $vid_id;

    if (!isset($_POST['like_vid_id'])) {
      redirect('index');
    } else {

      $vid_id = trim($_POST['like_vid_id']);

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // sanitize 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          // video id
          'unlike_vid_id' => $vid_id,

          // channel id
          'unlike_channel_id' => $_SESSION['channel_id']
        ];

        // add like
        $this->likeModel->deleteLike($data);

        // update com count
        $this->videoModel->updateLikes($vid_id, 'sub');

        redirect('view/video/' . $vid_id);

      } else {
        $this->video($vid_id);
      }
    }
  }

  // =========== COMMENT
  public function comment() {
    // get video id
    $vid_id = $_POST['com_vid_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize 
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        // comment
        'com_vid_id' => $vid_id,
        'com_channel_id' => $_SESSION['channel_id'],
        'com_content' => trim($_POST['com_content']),

        // error
        'com_content_error' => ''
      ];

      // validate
      if (empty($data['com_content'])) {
        $data['com_content_error'] = 'Please enter a comment';
      }

      // if no errors
      if (empty($data['com_content_error'])) {
        // add comment to database
        if ($this->commentModel->addComment($data)) {
          // flash 'comment added'
          flash('comment_added', 'Your comment has been added');

          // update com count
          $this->videoModel->updateComments($vid_id, 'add');

          // load updated view
          redirect('view/video/' . $vid_id);
          // $this->video($vid_id);
        } else {
          // flash 'comment not added'
          flash('comment_not_added', 'Something went wrong, please try again');

          // load view
          redirect('view/video/' . $vid_id);
        }
      } else {
        // flash comment empty
        flash('comment_empty', $data['com_content_error'], 'alert alert-danger');
        redirect('view/video/' . $vid_id);
      }

    } else {
      // Load Index if POST is not set
      $this->video($vid_id);
    }
  }

  public function edit_com($vid_id = null) {
    if ($vid_id == null) {
      redirect('index');
    } else {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // sanitize 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
        $data = [
          // comment edit
          'com_id' => trim($_POST['com_id']),
          'com_content' => trim($_POST['com_edit']),
  
          // error
          'com_content_error' => ''
        ];
  
        // validate
        if (empty($data['com_content'])) {
          $data['com_content_error'] = 'Please enter a comment';
        }
  
        // if no errors
        if (empty($data['com_content_error'])) {
          // edit comment
          $this->commentModel->editComment($data);
  
          redirect('view/video/' . $vid_id);
        } else {
  
          $this->video($vid_id);
        }
  
      } else {
        $this->video($vid_id);
      }
    }
  }

  //========= DELETE COMMENTS
  public function del_com() {
    $vid_id;

    if (!isset($_POST['com_vid_id'])) {
      redirect('index');
    } else {

      $vid_id = trim($_POST['com_vid_id']);

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // sanitize 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $com_id = trim($_POST['com_id']);

        // delete comment
        $this->commentModel->deleteComment($com_id);

        // update com count
        $this->videoModel->updateComments($vid_id, 'sub');

        echo 'view/video/' . $vid_id;
        // load view
        redirect('view/video/' . $vid_id);

      } else {
        $this->video($vid_id);
      }
    }
  }

}


?>