<?php
// APP DIR
define('APPROOT', dirname(dirname(__FILE__)));

// SERVER DIR
define('SERVERROOT', $_SERVER['DOCUMENT_ROOT'] . '/freetube/');

// URL DIR
define('URLROOT', 'http://localhost:8080/freetube');

// SITE NAME
define('SITENAME', 'Freetube');

// DATABASE CONFIG
class DatabaseConfig {
  protected $host = 'localhost';
  protected $user = 'root';
  protected $pw = 'root';
  protected $db = 'freetube';
}


?>