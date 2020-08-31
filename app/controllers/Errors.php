<?php 
//  ======== HOME CONTROLLER ========

class Errors extends Controller {

  public function __construct() {
    $this->categoryModel = $this->model('Category');
  }

  public function page_not_found() {

    $data = [
      'categories' => $this->categoryModel->getCategories()
    ];

    $this->view('error/404');
  }
}


?>