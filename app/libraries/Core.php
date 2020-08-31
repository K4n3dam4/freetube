<?php
// CREATES URL & LOADS CONTROLLER CORE

class CORE {
  protected $currentController = 'Home';
  protected $currentMethod = 'index';
  protected $param = [];

  public function __construct() {
    $url = $this->getUrl();

    // search url
    if ($url !== NULL && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // if page exists
      $this->currentController = ucwords($url[0]);

      // unset index
      unset($url[0]);

    } elseif ($url !== NULL && !file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      $this->currentController = 'Errors';
      $this->currentMethod = 'page_not_found';
    }

    // require controller
    require_once "../app/controllers/" . $this->currentController . '.php';

    // init class
    $this->currentController = new $this->currentController;

    // check for second value in url
    if(isset($url[1])) {
      if(method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];

        // unset index 1
        unset($url[1]);
      }
    }

    // get parameters
    $this->params = $url ? array_values($url) : [];

    // callback with parameter array
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  private function getUrl() {
    if(isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}


?>