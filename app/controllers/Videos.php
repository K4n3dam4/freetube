<?php
// ========= VIDEOS CONTROLLER ==========

class Videos extends Controller {

  public function __construct() {

    // require models
    $this->channelModel = $this->model('Channel');
    $this->videoModel = $this->model('Video');
    $this->categoryModel = $this->model('Category');
    $this->likeModel = $this->model('Like');
    $this->commentModel = $this->model('Comment');
  }


  // ======= INDEX
  public function index($channel_id = null) {
    $channel;
    $is_channel = false;

    if ($channel_id != null) {
      if (isset($_SESSION['channel_id'])) {
        if ($_SESSION['channel_id'] == $channel_id) {
          $is_channel = true;
        }
      }
    } else {
      if (isset($_SESSION['channel_id'])) {
        $is_channel = true;
        $channel_id = $_SESSION['channel_id'];
      } else {
        redirect('index');
      }
    }

    $channel = $this->channelModel->searchID($channel_id);
    $videos = $this->videoModel->getChannelVideos($channel_id);
    $categories = $this->categoryModel->getCategories();

    $data = [
      // title
      'title' => SITENAME,

      // channel
      'channel_img' => $channel['channel_img'],
      'channel_name' => $channel['channel_name'],
      'is_channel' => $is_channel,

      // videos
      'videos' => $videos,

      // video upload
      'vid_title' => '',
      'vid_cat_id' => '',
      'vid_channel_id' => $channel_id,
      'vid_tags' => '',

      // categories
      'categories' => $categories,

      // trying to upload
      'video_added' => false,

      // trying to edit
      'video_edited' => false,
    ];


    $this->view('videos/index', $data);
  }

  // ======= ADD VIDEO
  public function add() {
    $is_channel = true;
    $channel = $this->channelModel->searchID($_SESSION['channel_id']);
    $videos = $this->videoModel->getChannelVideos($_SESSION['channel_id']);
    $categories = $this->categoryModel->getCategories();

    // check mehtod post is set
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize 
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


      // handover data
      $data = [
        'title' => SITENAME,

        // videos
        'videos' => $videos,

        // channel
        'channel_img' => $channel['channel_img'],
        'channel_name' => $channel['channel_name'],
        'is_channel' => $is_channel,
  
        // categories
        'categories' => $categories,
  
        // video upload
        'vid_title' => trim($_POST['vid_title']),
        'vid_cat_id' => trim($_POST['vid_cat_id']),
        'vid_channel_id' => $_SESSION['channel_id'],
        'vid_tags' => trim($_POST['vid_tags']),
        'vid_upload_tmp' => $_FILES['vid_upload']['tmp_name'],
        'vid_upload' => $_FILES['vid_upload'],
        'vid_date' => date('Y-m-d'),

        // upload errors
        'vid_title_error' => '',
        'vid_cat_id_error' => '',
        'vid_tags_error' => '',
        'vid_upload_tmp_error' => '',
        'vid_upload_error' => '',

        // trying to upload
        'video_added' => true,

        // trying to edit
        'video_edited' => false,
      ];

      // validate
      if (empty($data['vid_title'])) {
        $data['vid_title_error'] = 'Please enter title';
      }

      if ($data['vid_cat_id'] == 'none-selected') {
        $data['vid_cat_id_error'] = 'Please select category';
      }

      if (empty($data['vid_tags'])) {
        $data['vid_tags_error'] = 'Please enter tags';
      }

      if (empty($data['vid_upload_tmp'])) {
        $data['vid_upload_error'] = 'Please select video';
      }

      // check for errors
      if (empty($data['vid_title_error']) && empty($data['vid_cat_id_error']) 
      && empty($data['vid_tags_error']) && empty($data['vid_upload_tmp_error'])) {
        // check and save video
        $vid_upload = uploadVideo($data['vid_upload'], 1000, 'assets/videos/channels/');
        
        // check if upload was successfull
        if (strpos($vid_upload, '.mp4') || strpos($vid_upload, 'mpeg')) {
          $data['vid_upload'] = $vid_upload;
        } else {
          $data['vid_upload_error'] = $vid_upload;
        }

        if (empty($data['vid_upload_error'])) {

          // try to add video to database
          try {
            // add
            $this->videoModel->addVideo($data);

            // successfull flash message
            flash('video_uploaded', "Your video has been successfully uploaded");

            // // load view
            redirect('videos/index');

          } catch (PDOException $e) {
            // catch error
            $error = 'Error: ' . $e->getMessage();

            // upload error flash message
            flash('video_not_uploaded', $error, 'alert alert-danger');

            // load view with upload database error
            $this->view('videos/index', $data);
          }


        } else {
          // load view with upload error
          $this->view('videos/index', $data);
        }

      } else {
        // load view with errors
        $this->view('videos/index', $data);
      }

    } else {
      // Load Index if POST is not set
      $this->index();
    }
  }

  // ======SEARCH CHANNEL
  public function keyword() {
    $is_channel = true;
    $channel = $this->channelModel->searchID($_SESSION['channel_id']);
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      if (empty($_POST['channel-search'])) {
        $this->index();

      } else {

        // search channel videos for keyword
        $videos = $this->videoModel->searchChannelVideos(
          $_SESSION['channel_id'], 
          trim($_POST['channel-search'])
        );

        // no result flash message
        if (empty($videos)) {
          flash('video_no_result', 'You have uploaded no videos containing this keyword', 'alert alert-danger text-center');
        }

        // handover data
        $data = [
          // title
          'title' => SITENAME,

          // channel
          'channel_img' => $channel['channel_img'],
          'channel_name' => $channel['channel_name'],
          'is_channel' => $is_channel,
  
          // videos
          'videos' => $videos,
  
          // categories
          'categories' => $categories,

          // video upload
          'vid_title' => '',
          'vid_cat_id' => '',
          'vid_channel_id' => $_SESSION['channel_id'],
          'vid_tags' => '',
  
          // trying to upload
          'video_added' => false,

          // trying to edit
          'video_edited' => false,
        ];
  
        $this->view('videos/index', $data);
      }
    } else {
      // load index
      $this->index();
    }
  }

  // ======= MANAGE CHANNEL
  public function delete() {
    $is_channel = true;
    $channel = $this->channelModel->searchID($_SESSION['channel_id']);
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      if (empty($_POST['del_vid'])) {
        // load video index
        $this->index();
      } else {
        $del_video = $this->videoModel->videoToDelete($_POST['del_vid']);
        $video = $this->videoModel->getChannelVideos($_SESSION['channel_id']);


        $data = [
          // title
          'title' => SITENAME,

          // channel
          'channel_img' => $channel['channel_img'],
          'channel_name' => $channel['channel_name'],
          'is_channel' => $is_channel,

          // videos
          'videos' => $video,

          // categories
          'categories' => $categories,

          // video upload
          'vid_title' => '',
          'vid_cat_id' => '',
          'vid_channel_id' => $_SESSION['channel_id'],
          'vid_tags' => '',

          // error
          'del_vid_error' => '',

          // trying to upload
          'video_added' => false,

          // trying to edit
          'video_edited' => false,
        ];

        // delete from database
        try {
          $this->videoModel->deleteChannelVideo($del_video['vid_id']);
        } catch (PDOException $e) {
          $data['del_vid_error'] = $e;
        }

        // delete likes
        $this->likeModel->deleteAllLikes($del_video['vid_id']);

        // delete comments
        $this->commentModel->deleteAllComments($del_video['vid_id']);

        // check for errors
        if (empty($data['del_vid_error'])) {
          // delete video from folder
          $data['del_vid_error'] = deleteFile($del_video['vid_url']);

          // update channel videos
          $data['videos'] = $this->videoModel->getChannelVideos($_SESSION['channel_id']);

          // set flash messages
          if (empty($data['del_vid_error'])) {
            flash('video_deleted', 'Video has been successfully removed');
          } else {
            flash('video_not_deleted', $data['del_vid_error'], 'alert alert-danger');
          }

          // load video index with flash
          redirect('videos/index');

        } else {
          // set flash message
          flash('video_not_deleted', $data['del_vid_error'], 'alert alert-danger');

          // load video index with flash
          redirect('videos/index');

        }

      }

    } else {
      // load video index
      $this->index();
    }
  }

  public function edit() {
    $is_channel = true;
    $channel = $this->channelModel->searchID($_SESSION['channel_id']);
    $videos = $this->videoModel->getChannelVideos($_SESSION['channel_id']);
    $categories = $this->categoryModel->getCategories();

    // check mehtod post is set
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize 
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // handover data
      $data = [
        'title' => SITENAME,

        // channel
        'channel_img' => $channel['channel_img'],
        'channel_name' => $channel['channel_name'],
        'is_channel' => $is_channel,

        // videos
        'videos' => $videos,

        // categories
        'categories' => $categories,

        // video id
        'vid_id' => $_POST['vid_id'],

        // video edit
        'edit_title' => trim($_POST['edit_title']),
        'edit_cat_id' => trim($_POST['edit_cat_id']),
        'edit_tags' => trim($_POST['edit_tags']),

        // video edit errors
        'edit_title_error' => '',
        'edit_tags_error' => '',

        // database error
        'edit_error' => '',

        // trying to upload
        'video_added' => false,

        // trying to edit
        'video_edited' => true,
      ];

      // validate
      if (empty($data['edit_title'])) {
        $data['edit_title_error'] = 'Please enter title';
      }

      if (empty($data['edit_tags'])) {
        $data['edit_tags_error'] = 'Please enter tags';
      }

      if (empty($data['edit_title_error']) && empty($data['edit_tags_error'])) {
        
        if ($this->videoModel->editChannelVideo($data)) {
          // successfull flash
          flash('video_edited', 'Video has been successfully edited');

          // redirect to video index 
          redirect('videos/index');
        } else {

          // not successfull
          flash('video_not_edited', 'Something went wrong. Try again', 'alert alert-danger');

          // redirect to video index
          redirect('videos/index');
        }
      } else {
        // load index with errors
        $this->view('videos/index', $data);
      }

    } else {
      // Load Index if POST is not set
      $this->index();
    }

  }

}


?>