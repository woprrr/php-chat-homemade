<?php

namespace App;

use PDO;
use PDOException;

class Database {
  static protected $_instance = null;

  protected $_db;

  static public function getInstance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new Database();
    }
    return self::$_instance;
  }

  protected function __construct() {
    try {
      $this->_db = new PDO('pgsql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';',Config::DB_USER,Config::DB_PASSWORD);
      $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      // In future use LOGGER service.
      echo $e->getMessage();
    }
  }

  public function __call($method, array $arg) {
    return call_user_func_array([$this->_db, $method], $arg);
  }
}
