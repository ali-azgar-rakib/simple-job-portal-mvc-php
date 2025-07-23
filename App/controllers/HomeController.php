<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class HomeController
{
  protected $db;
  public function __construct()
  {

    $config = require basePath("config/db.php");
    $this->db = new Database($config);
  }
  public function index()
  {
    $sql = "SELECT * FROM listings LIMIT 6";
    $listings = $this->db->query($sql)->fetchAll();

    loadView('home', [
      'listings' => $listings
    ]);
  }
}
