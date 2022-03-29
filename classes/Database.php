<?php

class Database
{
  protected $db_host;
  protected $db_name;
  protected $db_user;
  protected $db_pass;

  // Database configurations coming from `includes/db.php`
  public function __construct($host, $name, $user, $password)
  {
    $this->db_host = $host;
    $this->db_name = $name;
    $this->db_user = $user;
    $this->db_pass = $password;
  }

  public function getConn()
  {
    $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8';

    try {

      $db = new PDO($dsn, $this->db_user, $this->db_pass);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }
}

// Enclose the code that could cause an exception in a try catch block
// Catch block has an argument which is the exception object that is being thrown $e
// https://www.php.net/manual/en/class.exception.php
// https://www.php.net/manual/en/exception.getmessage.php
// $e object will have the ::getMessage method which return the detailed error message of the error that's occured.

// https://www.php.net/manual/en/pdo.error-handling.php
// If error occurs when working with the database an exception is thrown
// We set this attribute on the PDO object.
// Instead of returning it directly, we assign it to a variable $db
// Then set the attribute that throws exceptions and then return the object
