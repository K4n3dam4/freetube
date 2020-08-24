<?php

// Base Controller
// Loads the models and views

class Controller {
  
  // Load model
  public function model($model) {
    // require model
    require_once '../app/models/' . $model . '.php';

    // instant
    return new $model();
  }

  // load view
  public function view($view, $data = []) {
    // check for file
    if (file_exists('../app/views/' . $view . '.php')) {
      require_once '../app/views/' . $view . '.php';
    } else {
      // file does not exist
      die('View does not exist');
    }
  }
  
}


?>