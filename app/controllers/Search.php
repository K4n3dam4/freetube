<?php 
// =========== SEARCH ===========

class Search extends Controller {

  public function __construct() {
    $this->videoModel = $this->model('Video');
    $this->categoryModel = $this->model('Category');
  }

  public function keyword() {
    // all categories
    $categories = $this->categoryModel->getCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


      if (empty($_POST['search'])) {
        // get all videos
        // $videos = $this->videoModel->getVideos();

        // // data array
        // $data = [
        //   'title' => SITENAME,
        //   'videos' => $videos,
        //   'categories' => $categories
        // ];

        // // load index hand over data

        // $this->view('search/keyword', $data);
        

        // redirect to index if empty
        redirect('index');

      } else {

        // // search videos
        // $videos = $this->videoModel->searchVideos(trim($_POST['search']));

        // // hand over data
        // $data = [
        //   // search word
        //   'search' => trim($_POST['search']),

        //   // videos
        //   'videos' => $videos,
        //   // categories
        //   'categories' => $categories
        // ];

        // // load index hand over data
        // $this->view('search/keyword', $data);

        // load view with keyword for ajax request
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


}




?>