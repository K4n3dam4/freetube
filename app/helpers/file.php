<?php 
// ======= CHECK FILES =========


// check videos and upload
function uploadVideo(array $file, int $maxSize, string $path, $channel_path = null) {

  // if no error
  if ($file['error'] === UPLOAD_ERR_OK) {


    if ($file['size'] < 1080 * 1080 * $maxSize ) {

      // check for video format
      if ($file['type'] == 'video/mpeg' || $file['type'] == 'video/mp4') {
        // admin or user
        if ($channel_path == null) {
          $path = $path . $_SESSION['channel_id'];
        } else {
          $path = $path . $channel_path;
        }

        // if path doesn't exist mkdir
        if (!file_exists($path)) {
          mkdir($path, 0777, true);
        }

        //move video
        $path = $path . '/' . $file['name'];
        

        $video = move_uploaded_file($file['tmp_name'], $path);

        return $path;

      } else {
        return "Your video must be in .mpeg or .mp4 format";
      }

    } else {
      return "Your video is too big.";
    }

  } else {
    return "Upload error occurred. Please try again.";
  }
}

// check img and upload
function uploadImg(array $file, int $maxSize, string $path, $channel_path = null) {

  // if no error
  if ($file['error'] === UPLOAD_ERR_OK) {


    if ($file['size'] < 1080 * 1080 * $maxSize ) {

      // check for video format
      if ($file['type'] == 'image/jpg' || $file['type'] == 'image/png' || $file['type'] == 'image/jpeg') {
        
        // admin or user
        if ($channel_path == null) {
          $path = $path . $_SESSION['channel_id'];
        } else {
          $path = $path . $channel_path;
        }

        // if path doesn't exist mkdir
        if (!file_exists($path)) {
          mkdir($path, 0777, true);
        }

        //move video
        $path = $path . '/' . $file['name'];
        

        $video = move_uploaded_file($file['tmp_name'], $path);

        return $path;

      } else {
        return "Your image must be in .jpg, .jpeg or .png format";
      }

    } else {
      return "Your image is must be smaller than 10mb";
    }

  } else {
    return "Upload error occurred. Please try again";
  }
}

// delete file from server
function deleteFile(string $dir) {
  $path = SERVERROOT . 'public/' . $dir;

  if (unlink($path)) {
    return;
  } else {
    return 'There occurred an error';
  }
}

?>