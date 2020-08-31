<?php
//  ======== CHANNELS CONTROLLER ========

class Channels extends Controller {
  // require models
  public function __construct() {
    $this->categoryModel = $this->model('Category');
    $this->channelModel = $this->model('Channel');
  }

  public function index() {
    redirect('errors/page_not_found');
  }

  // ======SIGNUP
  public function signup() {
    // all categories
    $categories = $this->categoryModel->getCategories();

    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // process

      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // handover data
      $data = [
        'title' => SITENAME,

        // categories
        'categories' => $categories,

        // input
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'owner' => trim($_POST['owner']),
        'pwd' => trim($_POST['pwd']),
        'pwd_rpt' => trim($_POST['pwd_rpt']),
        
        // errors
        'name_error' => '',
        'email_error' => '',
        'owner_error' => '',
        'pwd_error' => '',
        'pwd_rpt_error' => ''
      ];

      // validate channel name
      if(empty($data['name'])) {
        $data['name_error'] = 'Please enter channel name';
      } else if ($this->channelModel->searchName($data['name']) == true) {
        // error if channel exists
        $data['name_error'] = 'Name is already taken';
      }

      // validate channel email
      if(empty($data['email'])) {
        $data['email_error'] = 'Please enter channel email';
      } else if ($this->channelModel->searchEmail($data['email'])) {
        // error if email exists
        $data['email_error'] = 'Email is already taken';

      }

      // validate channel owner
      if(empty($data['owner'])) {
        $data['owner_error'] = 'Please enter your name';
      }

      // validate channel password
      $length = strlen($data['pwd']);
      $uppercase = preg_match('@[A-Z]@', $data['pwd']);
      $number = preg_match('@[0-9]@', $data['pwd']);
      $lowercase = preg_match('@[a-z]@', $data['pwd']);
      $specialChars = preg_match('@[^\w]@', $data['pwd']);
      
      if (empty($data['pwd'])) {
        $data['pwd_error'] = 'Please enter password';
      } else if (!$uppercase || !$lowercase || !$number || !$specialChars || $length < 8) {
        $data['pwd_error'] = 
        'Your password needs to:<br>
        - include at least one number<br>
        - include at least one special character<br>
        - include at least one uppercase and one lowercase character<br>
        - be at least 8 characters long';
      }

      // validate channel password repeat
      if (empty($data['pwd_rpt'])) {
        $data['pwd_rpt_error'] = 'Please repeat password';
      } else if ($data['pwd_rpt'] != $data['pwd']) {
        $data['pwd_rpt_error'] = 'Your passwords do not match';
      }

      // check if errors empty
      if (empty($data['name_error']) && empty($data['email_error']) && empty($data['owner_error'])
      && empty($data['pwd_error']) && empty($data['pwd_rpt_error'])) {
        // validated successfully

        // hash pwd
        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

        // add user to databse
        try {
          $this->channelModel->add($data);
          flash('register_success', 'You are signed up and can now log in');
          redirect('channels/login');

        } catch (PDOException $e) {
          // catch error
          $error = 'Error: ' . $e->getMessage();

          // load signup with flash error 
          flash('register_danger', $error, 'alert alert-danger');
          $this->view('/channels/signup');
        }

      } else {
        // load signup with errors
        $this->view('/channels/signup', $data);
      }

    } else {
      // hand over data
      $data = [
        'title' => SITENAME,

        // categories
        'categories' => $categories,

        // input
        'name' => '',
        'email' => '',
        'owner' => '',
        'pwd' => '',
        'pwd_rpt' => '',
        
        // errors
        'name_error' => '',
        'email_error' => '',
        'owner_error' => '',
        'pwd_error' => '',
        'pwd_rpt_error' => ''
      ];

      // load view
      $this->view('/channels/signup', $data);
    }
  }

  // ===== SESSION START
  public function startSession($channel) {
    $_SESSION['channel_id'] = $channel['channel_id'];
    $_SESSION['channel_is_admin'] = $channel['channel_is_admin'];
    $_SESSION['channel_name'] = $channel['channel_name'];
    $_SESSION['channel_img'] = $channel['channel_img'];
    $_SESSION['channel_owner'] = $channel['channel_owner'];
    $_SESSION['channel_email'] = $channel['channel_email'];

    redirect('home/index');
  }

  // ===== LOGIN
  public function login(){
    // all categories
    $categories = $this->categoryModel->getCategories();

    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // handover data
      $data = [
        'title' => SITENAME,

        // categories
        'categories' => $categories,

        // input
        'email' => trim($_POST['email']),
        'pwd' => trim($_POST['pwd']),

        // errors
        'email_error' => '',
        'pwd_error' => '',
      ];

      // validate channel email
      if(empty($data['email'])) {
        $data['email_error'] = 'Please enter channel email';
      }
      
      // validate password
      if (empty($data['pwd'])) {
        $data['pwd_error'] = 'Please enter password';
      }

      //check for email
      if ($this->channelModel->searchEmail($data['email'])) {
        // channel exists
      } else {
        $data['email_error'] = 'Email doesn\'t exist';
      }
      

      // check if errors empty
      if (empty($data['email_error']) && empty($data['pwd_error'])) {
        // validated successfully
        // set logged in channel
        $loggedInChannel = $this->channelModel->login($data['email'], $data['pwd']);

        if($loggedInChannel) {
          // start session
          $this->startSession($loggedInChannel);
        } else {
          // password incorrect
          $data['pwd_error'] = 'Password incorrect';
          $this->view('channels/login', $data);
        }
      } else {
        // load login with errors
        $this->view('/channels/login', $data);
      }


    } else {
      // init data
      $data = [
        'title' => SITENAME,

        // categories
        'categories' => $categories,
        
        // input
        'email' => '',
        'pwd' => '',
        
        // errors
        'email_error' => '',
        'pwd_error' => '',
      ];

      // load view
      $this->view('/channels/login', $data);
    }
  }

  // ====== LOGOUT
  public function logout($profile_update = false) {
    // unset session variables
    unset($_SESSION['channel_id']);
    unset($_SESSION['channel_is_admin']);
    unset($_SESSION['channel_name']);
    unset($_SESSION['channel_img']);
    unset($_SESSION['channel_owner']);
    unset($_SESSION['channel_email']);

    // end session
    session_destroy();

    redirect('home/index');
  }

  public function profile() {
    $categories = $this->categoryModel->getCategories();
    // hand over data
    $data = [
      'title' => SITENAME,

      // channel_id
      'channel_id' => $_SESSION['channel_id'],

      // categories
      'categories' => $categories,

      // input
      'name' => $_SESSION['channel_name'],
      'email' => $_SESSION['channel_email'],
      'owner' => $_SESSION['channel_owner'],
      'pwd' => 'placeholderpwd',
      'pwd_rpt' => 'placeholderpwd',
      
      // errors
      'name_error' => '',
      'email_error' => '',
      'owner_error' => '',
      'pwd_error' => '',
      'pwd_rpt_error' => ''
    ];

    // load view
    $this->view('/channels/edit', $data);
  }


  // EDIT PROFILE
  public function edit() {
    $categories = $this->categoryModel->getCategories();

    if (isLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // sanitize
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // hand over data
        $data = [
          'title' => SITENAME,

          // channel_id
          'channel_id' => $_SESSION['channel_id'],

          // categories
          'categories' => $categories,

          // input
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'owner' => trim($_POST['owner']),
          'img' => $_FILES['img'],
          'img_tmp' => $_FILES['img']['tmp_name'],
          'pwd' => trim($_POST['pwd']),
          'pwd_rpt' => trim($_POST['pwd_rpt']),
          
          // errors
          'name_error' => '',
          'email_error' => '',
          'owner_error' => '',
          'img_error' => '',
          'pwd_error' => '',
          'pwd_rpt_error' => ''
        ];

        // validate channel name
        if(empty($data['name'])) {
          $data['name_error'] = 'Please enter channel name';
        } else if ($data['name'] != $_SESSION['channel_name']) {
          if ($this->channelModel->searchName($data['name']) == true) {
            // error if channel exists
            $data['name_error'] = 'Name is already taken';
          }
        }

        // validate channel email
        if(empty($data['email'])) {
          $data['email_error'] = 'Please enter channel email';
        } else if ($data['email'] != $_SESSION['channel_email']) {
          if ($this->channelModel->searchEmail($data['email'])) {
          // error if email exists
          $data['email_error'] = 'Email is already taken';
          }
        }

        // validate channel owner
        if(empty($data['owner'])) {
          $data['owner_error'] = 'Please enter your name';
        }

        // validate channel password
        $length = strlen($data['pwd']);
        $uppercase = preg_match('@[A-Z]@', $data['pwd']);
        $number = preg_match('@[0-9]@', $data['pwd']);
        $lowercase = preg_match('@[a-z]@', $data['pwd']);
        $specialChars = preg_match('@[^\w]@', $data['pwd']);
        
        if (empty($data['pwd'])) {
          $data['pwd_error'] = 'Please enter password';
        } else if ($data['pwd'] != 'placeholderpwd') {
          if (!$uppercase || !$lowercase || !$number || !$specialChars || $length < 8) {
          $data['pwd_error'] = 
          'Your password needs to:<br>
          - include at least one number<br>
          - include at least one special character<br>
          - include at least one uppercase and one lowercase character<br>
          - be at least 8 characters long';
          }
        }

        // validate channel password repeat
        if (empty($data['pwd_rpt'])) {
          $data['pwd_rpt_error'] = 'Please repeat password';
        } else if ($data['pwd_rpt'] != $data['pwd']) {
          $data['pwd_rpt_error'] = 'Your passwords do not match';
        }

        // check if empty errors
        if (empty($data['name_error']) && empty($data['email_error']) && empty($data['owner_error']) 
        && empty($data['pwd_error']) && empty($data['pwd_rpt_error'])) {
          // update session
          $_SESSION['channel_name'] = $data['name'];
          $_SESSION['channel_owner'] = $data['owner'];
          $_SESSION['channel_email'] = $data['email'];

          // check for new profile image
          if (!empty($data['img_tmp'])) {
            $img_upload = uploadImg($data['img'], 10, 'assets/images/channels/');

            if (strpos($img_upload, 'Your image') || strpos($img_upload, 'Upload error')) {
              // set image upload error
              $data['img_error'] = $img_upload; 
            } else {
              // $data['img] = image path
              $data['img'] = $img_upload;

              // update database
              if (!$this->channelModel->profileImage($data)) {
                flash('img_update_error', 'An error occurred while updating your picture', 'alert alert-danger'); 
              } else {
                // don't delete if switich from profile_default image
                if (!strpos($_SESSION['channel_img'], 'profile_default')) {
                  deleteFile($_SESSION['channel_img']);
                }

                // update session image
                $_SESSION['channel_img'] = $data['img'];
              }
            }
          }

          // check for new password
          if ($data['pwd'] == 'placeholderpwd') {
            // if password doesn't need to be changed
            if($this->channelModel->editProfile($data, false)) {
              flash('profile_updated', 'Your profile has been updated successfully');
              $this->profile();
            } else {
              flash('profile_error', 'Something went wrong, please try again', 'alert alert-danger');
              $this->profile();
            }
          } else {
            // if password has been changed
            // hash pwd
            $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

            if ($this->channelModel->editProfile($data, true)) {
              flash('profile_updated', 'Your profile has been updated successfully');
              $this->profile();
            } else {
              flash('profile_error', 'Something went wrong, please try again', 'alert alert-danger');
              $this->profile();
            }
          }
        } else {
          // load view with errors
          $this->view('/channels/edit', $data);
        }

        
      } else {
        $this->profile();
      }

    } else {
      redirect('channels/login');
    }
    
  }
}



?>