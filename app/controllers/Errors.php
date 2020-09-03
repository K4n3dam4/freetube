<?php 
//  ======== HOME CONTROLLER ========

class Errors extends Controller {

  public function __construct() {
    $this->categoryModel = $this->model('Category');
  }

  public function page_not_found() {

    $data = [
      // categories
      'categories' => $this->categoryModel->getCategories()
    ];

    // load error view
    $this->view('error/404');
  }
}


?>