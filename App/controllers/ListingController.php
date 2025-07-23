<?php

namespace App\Controllers;

use Framework\Database;
use App\Controllers\ErrorController;

class ListingController
{
  protected $db;
  public function __construct()
  {

    $config = require basePath("config/db.php");
    $this->db = new Database($config);
  }
  public function index()
  {
    $sql = "SELECT * FROM listings";
    $listings = $this->db->query($sql)->fetchAll();

    loadView('listings/index', [
      'listings' => $listings
    ]);
  }

  public function create()
  {
    loadView('listings/create');
  }
  public function show($params)
  {
    if (!ctype_digit($params['id'])) return ErrorController::notFound();

    $id = $params['id'] ?? '';
    $param = [
      'id' => $id
    ];
    $sql = "SELECT * FROM listings WHERE id = :id";
    $data = $this->db->query($sql, $param);
    $listing = $data->fetch();

    if (!$listing) return ErrorController::notFound();


    loadView('listings/show', [
      'listing' => $listing
    ]);
  }
}
