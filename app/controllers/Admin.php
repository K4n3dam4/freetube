<?php 

// ========== Admin Panel ============

class Admin extends Controller {

  public function __construct() {
    if (!isAdmin()) {
      redirect('channels/login');
    }

    // require models
    $this->channelModel = $this->model('Channel');
    $this->videoModel = $this->model('Video');
    $this->categoryModel = $this->model('Category');
    $this->likeModel = $this->model('Like');
    $this->commentModel = $this->model('Comment');
  }

  public function index() {
    redirect('errors/page_not_found');
  }

  public function dashboard() {
    $channel_count = $this->channelModel->countChannels();
    $categories = $this->categoryModel->getCategories();
    $cat_count = $this->categoryModel->countCats();
    $vid_count = $this->videoModel->countVideos();
    $com_count = $this->commentModel->countComments();
    $like_count = $this->likeModel->countLikes();

    // best channels
    $best_channels = $this->channelModel->mostLikedChannels();

    $data = [
      'title' => SITENAME,

      // categories
      'categories' => $categories,
      
      // channel amount
      'channel_count' => $channel_count,
      // categories amount
      'cat_count' => $cat_count,
      // video amount
      'vid_count' => $vid_count,
      // comment count
      'com_count' => $com_count,
      // like amount
      'like_count' => $like_count,

      // best channels
      'best_channels' => $best_channels
    ];
      
    $this->view('admin/dashboard', $data);
  }

  // ======VIDEOS

  // videos table
  public function videos() {
    $videos = $this->videoModel->getVideos();
    $categories = $this->categoryModel->getCategories();

    $data = [
      // videos
      'videos' => $videos,

      // categories
      'categories' => $categories
    ];

    $this->view('admin/videos', $data);
  }

  // edit video
  public function edit_video() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $videos = $this->videoModel->getVideos();
      $categories = $this->categoryModel->getCategories();
      $edit_video = $this->videoModel->getVideo(trim($_POST['vid-id']));
      
      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        // videos
        'videos' => $videos,

        // categories
        'categories' => $categories,

        // channel
        'vid_id' => trim($_POST['vid-id']),

        'vid_title' => trim($_POST['vid-title']),
        'vid_cat_id' => trim($_POST['vid-category']),
        'vid_tags' => trim($_POST['vid-tags']),
        'video' => $_FILES['video'],
        'video_tmp' => $_FILES['video']['tmp_name'],
        'vid_com_count' => trim($_POST['vid-com-count']),
        'vid_like_count' => trim($_POST['vid-like-count']),

        // errors
        'vid_title_error' => '',
        'vid_tags_error' => '',
        'video_error' => '',
      ];

      // validate vid_title
      if (empty($data['vid_title'])) {
        $data['vid_title_error'] = 'Please enter a video title';
      }

      // validate vid_tags
      if (empty($data['vid_tags'])) {
        $data['vid_tags_error'] = 'Please enter video tags';
      }

      // validate vid com count
      if (empty($data['vid_com_count'])) {
        $data['vid_com_count'] = 0;
      }

      // validate vid like count
      if (empty($data['vid_com_count'])) {
        $data['vid_com_count'] = 0;
      }

      // check if empty errors
      if(empty($data['vid_title_error']) && empty($data['vid_tags_error'])) {

        // check for new video
        if (!empty($data['video_tmp'])) {
          $video_upload = uploadVideo($data['video'], 1000, 'assets/videos/channels/', $edit_video['channel_id']);

          if (strpos($video_upload, 'Your video') || strpos($video_upload, 'Upload error')) {
            // set image upload error
            $data['video_error'] = $video_upload; 
          } else {
            // $data['img'] = image path
            $data['video'] = $video_upload;

            // update database
            if (!$this->videoModel->updateVideoURL($data)) {
              flash('video_update_error', 'An error occurred while updating the video', 'alert alert-danger'); 
            } else {
              // delete old video
              deleteFile($edit_video['vid_url']);
            }
          }
        }

        // update database
        if ($this->videoModel->editAdminVideo($data)) {
          flash('video_updated', 'The channel has been updated successfully');
          redirect('admin/videos');
        } else {
          flash('video_updtade_error', 'An error occurred, please try again', 'alert alert-danger');
          redirect('admin/videos');
        }

      } else {
        $this->view('admin/videos', $data);
      }
    } else {
      $this->videos();
    }

  }

  public function del_vid($vid_id = null) {
    if ($vid_id != null) {
      // get video
      $del_vid = $this->videoModel->getVideo($vid_id);

      // delete video
      $this->videoModel->deleteChannelVideo($vid_id);
      // delete likes
      $this->likeModel->deleteAllLikes($vid_id);
      // delete comments
      $this->commentModel->deleteAllComments($vid_id);
      // delete video
      deleteFile($del_vid['vid_url']);

      flash('video_deleted', 'The video has been deleted successfully');
      redirect('admin/videos');
    } else {
      $this->videos();
    }
  }

  // ======CHANNELS

  // channels table
  public function channels() {
    $channels = $this->channelModel->getAllChannels();

    $data = [
      // channels
      'channels' => $channels
    ];

    $this->view('admin/channels', $data);
  }

  // edit channel
  public function edit_channel() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $channels = $this->channelModel->getAllChannels();
      $edit_channel = $this->channelModel->searchID(trim($_POST['channel-id']));

      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // hand over data
      $data = [
        'title' => SITENAME,

        // channels
        'channels' => $channels,

        // channel_id
        'channel_id' => trim($_POST['channel-id']),

        // input
        'is_admin' => trim($_POST['is-admin']),
        'channel_name' => trim($_POST['channel-name']),
        'channel_email' => trim($_POST['channel-email']),
        'channel_owner' => trim($_POST['channel-owner']),
        'img' => $_FILES['img'],
        'img_tmp' => $_FILES['img']['tmp_name'],
        
        // errors
        'channel_name_error' => '',
        'channel_email_error' => '',
        'channel_owner_error' => '',
        'img_error' => '',
      ];

      // validate channel name
      if (empty($data['channel_name'])) {
        $data['channel_name_error'] = 'Please enter channel name';
      } else {
        foreach ($channels as $key => $channel) {
          if ($data['channel_id'] != $channel['channel_id'] && 
          $data['channel_name'] == $channel['channel_name']) {
            $data['channel_name_error'] = 'Channel name is already taken';
          }
        }
      }

      if (empty($data['channel_email'])) {
        $data['channel_email_error'] = 'Please enter channel name';
      } else {
        foreach ($channels as $key => $channel) {
          if ($data['channel_id'] != $channel['channel_id'] && 
          $data['channel_email'] == $channel['channel_email']) {
            $data['channel_email_error'] = 'Email is already taken';
          }
        }
      }

      // validate channel owner
      if(empty($data['channel_owner'])) {
        $data['channel_owner_error'] = 'Please enter a name';
      }

      // check if empty errors
      if (empty($data['channel_name_error']) && empty($data['channel_email_error']) && 
      empty($data['channel_owner_error'])) {
        
        // check for new profile image
        if (!empty($data['img_tmp'])) {
          $img_upload = uploadImg($data['img'], 10, 'assets/images/channels/', $data['channel_id']);

          if (strpos($img_upload, 'Your image') || strpos($img_upload, 'Upload error')) {
            // set image upload error
            $data['img_error'] = $img_upload; 
          } else {
            // $data['img'] = image path
            $data['img'] = $img_upload;

            // update database
            if (!$this->channelModel->profileImage($data)) {
              flash('img_update_error', 'An error occurred while updating your picture', 'alert alert-danger'); 
            } else {
              // don't delete if switich from profile_default image
              if (!strpos($edit_channel['channel_img'], 'profile_default')) {
                deleteFile($edit_channel['channel_img']);
              }
            }
          }
        }

        // update database
        if ($this->channelModel->editProfileAdmin($data)) {
          flash('channel_updated', 'The channel has been updated successfully');
          redirect('admin/channels');
        } else {
          flash('channel_updtade_error', 'An error occurred, please try again', 'alert alert-danger');
          redirect('admin/channels');
        }

      } else {
        $this->view('admin/channels', $data);
      }

      
    } else {
      $this->channels();
    }
    
  }

  // delete channel
  public function del_channel($channel_id = null) {
    if ($channel_id != null) {
      $this->channelModel->deleteChannel($channel_id);
      flash('channel_deleted', 'The channel has been deleted successfully');
      redirect('admin/channels');
    } else {
      $this->channels();
    }
  }

  // ========COMMENTS

  public function comments() {
    $comments = $this->commentModel->getCommentsAdmin();

    $data = [
      // comments
      'comments' => $comments,
    ];

    $this->view('admin/comments', $data);
  }

  // edit comment
  public function edit_comment() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        // comment id
        'com_id' => trim($_POST['com-id']),

        // comment content
        'com_content' => trim($_POST['com-content'])
      ];

      if (empty($data['com_content'])) {
        flash('com-content-error0', 'Please enter a comment', 'alert alert-danger');
        redirect('admin/comments');
      } else {
        if($this->commentModel->editComment($data)) {
          flash('com-content-success', 'The comment has been updated successfully');
          redirect('admin/comments');
        } else {
          flash('com-content-error1', 'Something went wrong, please try again', 'alert alert-danger');
          redirect('admin/comments');
        }
      }

    } else {
      $this->comments();
    }
  }

  // delete comment
  public function del_comment($com_id = null) {
    $comment = $this->commentModel->getCommentById($com_id);

    if ($com_id != null && $comment != false) {
      if ($this->commentModel->deleteComment($com_id)) {
        // update com count
        $this->videoModel->updateComments($comment['com_vid_id'], 'sub');

        // flash message
        flash('com-deleted', 'The comment has been deleted successfully');

        // // redirect to admin comments
        redirect('admin/comments');
      } else {
        flash('com-del-error', 'Something went wrong, please try again', 'alert alert-danger');
        redirect('admin/comments');
      }
    } else {
      $this->comments();
    }
  }

  // =======CATEGORIES

  // categories table
  public function categories() {
    $categories = $this->categoryModel->getCategories();

    $data = [
      'categories' => $categories
    ];

    $this->view('admin/categories', $data);
  }

  // add category
  public function add_cat() {
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize 
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        // categories
        'categories' => $categories,

        // new
        'new_cat' => trim($_POST['new']),

        // errors
        'new_cat_error' => '',
      ];
        
      // validate
      if (empty($data['new_cat'])) {
        $data['new_cat_error'] = 'Please enter a category name';
        $this->view('admin/categories', $data);
      } else {
        // add to database
        if ($this->categoryModel->addCategory($data)) {
          flash('new_cat_success', 'Category has been added successfully');
          redirect('admin/categories');
        } else {
          flash('new_cat_error', 'An error occurred, please try again', 'alert alert-danger');
          redirect('admin/categories');
        }
      }

    } else {
      $this->categories();
    }

  }

  // edit category
  public function edit_cat() {
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // sanitize 
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        // categories
        'categories' => $categories,

        // edit
        'edit_cat_id' => trim($_POST['edit-cat-id']),
        'edit_cat' => trim($_POST['edit']),

        // errors
        'edit_cat_error' => ''
      ];
        
      // validate
      if (empty($data['edit_cat'])) {
        flash('edit_empty_error', 'Please enter valid category name', 'alert alert-danger');
        $this->view('admin/categories', $data);
      } else {

        // edit category
        if ($this->categoryModel->editCategory($data)) {
          flash('edit_cat_success', 'Category has been edited successfully');
          redirect('admin/categories');
        } else {
          flash('edit_cat_error', 'An error occurred, please try again', 'alert alert-danger');
          redirect('admin/categories');
        }
      }
    } else {
      $this->categories();
    }

  }

  // delete category
  public function del_cat() {
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // sanitize 
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


      $del_cat_id = trim($_POST['del-cat']);

      // delete category
      $this->categoryModel->deleteCategory($del_cat_id);

      $this->categories();

    } else {

      $this->categories();
    }
  } 

}




?>