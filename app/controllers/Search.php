<?php 
// =========== SEARCH ===========

class Search extends Controller {

  public function __construct() {
    $this->videoModel = $this->model('Video');
    $this->categoryModel = $this->model('Category');
  }

  // search keyword
  public function keyword() {
    // all categories
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


      if (empty($_POST['search'])) {

        redirect('index');

      } else {
        $data = [
          'categories' => $categories,
          'search' => trim($_POST['search']),
        ];

        $this->view('search/keyword', $data);
      }

    } else {
      redirect('index');
    }
  }

  // search category
  public function category($cat_id = NULL) {
    // all categories
    $categories = $this->categoryModel->getCategories();

    if ($cat_id != NULL) {
      $videos_empty;

      if ($this->videoModel->countVideosCat($cat_id) > 0) {
        $videos_empty = false;
      } else {
        $videos_empty = true;
      }

      $data = [
        'categories' => $categories,
        'videos_empty' => $videos_empty,
        'search' => $cat_id,
      ];

      $this->view('search/category', $data);
    } else {
      // no cat id redirect to index
      redirect('index');
    }
  }


}




?>