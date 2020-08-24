<?php 
//  ======== HOME CONTROLLER ========

class Home extends Controller {
  // require models
  public function __construct() {
    $this->videoModel = $this->model('Video');
    $this->categoryModel = $this->model('Category');
  }


  public function index() {
    // all categories
    $categories = $this->categoryModel->getCategories();


    // data array
    $data = [
      'title' => SITENAME,
      'categories' => $categories
    ];

    // load index hand over data
    $this->view('index', $data);
  }
}


?>