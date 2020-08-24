<?php 

// ======CONFIG
require 'config/config.php';

// ======HELPERS
require_once 'helpers/session.php';
require_once 'helpers/url.php';
require_once 'helpers/file.php';
require_once 'helpers/table.php';

// ======LIBRARIES
class Autoloader {
  static public function loader($className) {
    require_once 'libraries/' . $className . '.php';
  }
}

spl_autoload_register('Autoloader::loader');

?>