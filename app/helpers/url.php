<?php 

// ============REDIRECT============

function redirect($url, $refreshtime = null) {
  if(isset($refreshtime)) {
    echo header('refresh:' . $refreshtime . ';url=' . URLROOT . '/' . $url);
  } else {
    echo header('Location:' . URLROOT . '/' . $url);
  }

  return $url;
}




?>