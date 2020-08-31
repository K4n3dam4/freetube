<?php 
// =========== SEARCH ===========

class Search extends Controller {

  public function __construct() {
    $this->videoModel = $this->model('Video');
    $this->categoryModel = $this->model('Category');
  }

  public function index() {
    redirect('errors/page_not_found');
  }

  // search keyword
  public function keyword() {
    // all categories
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $videos_empty = NULL;
      $keyword = trim($_POST['search']);

      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      if (!$this->videoModel->countVideosSearch($keyword)) {
        $videos_empty = true;
      }

      if (empty($_POST['search'])) {

        redirect('home/index');

      } else {
        $data = [
          'categories' => $categories,
          'videos_empty' => $videos_empty,
          'search' => $keyword,
        ];

        $this->view('search/keyword', $data);
      }

    } else {
      redirect('home/index');
    }
  }

  // search category
  public function category($cat_id = NULL) {
    // all categories
    $categories = $this->categoryModel->getCategories();

    if ($cat_id != NULL) {
      $videos_empty = NULL;

      if ($this->videoModel->countVideosSearch($cat_id) == 0) {
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
      redirect('home/index');
    }
  }


}




?>