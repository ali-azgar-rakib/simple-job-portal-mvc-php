<?php

namespace App\Controllers;

use Framework\Database;
use App\Controllers\ErrorController;
use Framework\Authorization;
use Framework\Session;
use Framework\Validation;

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

  /**
   *
   * Show single listings
   *
   * @param array $params
   * @return void
   * */


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

  /**
   *
   * Store listing data
   *
   * @return void
   *
   * */
  public function store()
  {
    $authorizeField = ['title', 'description', 'salary', 'requirements', 'benefits', 'company', 'address', 'city', 'state', 'phone', 'email', 'tags'];
    $newListing = array_intersect_key($_POST, array_flip($authorizeField));
    $newListing['user_id'] = Session::get('user')['user_id'];
    $newListing = array_map('sanitize', $newListing);
    $requiredField = ['title', 'description', 'salary', 'requirements', 'company', 'city', 'phone', 'email'];
    $errors = [];
    foreach ($requiredField as $field) {

      if (empty($newListing[$field]) || !Validation::string($newListing[$field])) {
        $errors[$field] = ucfirst($field) . " is required.";
      }
    }
    if (!empty($errors)) {
      loadView('listings/create', [
        'errors' => $errors,
        'data' => (object) $newListing
      ]);
    } else {
      $keys = [];
      $values = [];
      foreach ($newListing as $key => $value) {
        $keys[] = $key;
        $values[] = ":" . $key;
      }

      $keyStr = implode(", ", $keys);
      $valueStr = implode(", ", $values);
      $sql = "INSERT INTO listings ({$keyStr}) VALUES ({$valueStr})";
      $this->db->query($sql, $newListing);
      Session::setFlushMessage('success_message', 'Added successfully!');
      redirect("/listings");
    }
  }

  /**
   *
   * Delete single listings
   *
   * @param array $params
   * return void
   *
   *
   * */


  public function destroy($params)
  {
    $id = $params['id'];
    $params = [
      'id' => $id
    ];
    $getSql = "SELECT * FROM listings WHERE id=:id";
    $listing = $this->db->query($getSql, $params)->fetch();

    if (!$listing) {
      ErrorController::notFound("Listing not found");
    }
    if (! Authorization::isOwner($listing->user_id)) {
      ErrorController::notAuthorize();
      exit;
    }
    $deleteSql = "DELETE FROM listings WHERE id=:id";
    $this->db->query($deleteSql, $params);
    Session::setFlushMessage('success_message', 'Deleted successfully!');
    redirect("/listings");
  }

  /**
   *
   * Edit single listings
   *
   * @param array $params
   * @return void
   * */


  public function edit($params)
  {
    if (!ctype_digit($params['id'])) return ErrorController::notFound();

    $id = $params['id'] ?? '';
    $param = [
      'id' => $id
    ];
    $sql = "SELECT * FROM listings WHERE id = :id";
    $data = $this->db->query($sql, $param);
    $listing = $data->fetch();

    if (! Authorization::isOwner($listing->user_id)) {
      ErrorController::notAuthorize();
      exit;
    }

    if (!$listing) return ErrorController::notFound();


    loadView('listings/edit', [
      'data' => $listing
    ]);
  }

  /**
   *
   * Update listing data
   *
   * @return void
   *
   * */
  public function update($params)
  {

    if (!ctype_digit($params['id'])) return ErrorController::notFound();

    $id = $params['id'] ?? '';
    $param = [
      'id' => $id
    ];
    $sql = "SELECT * FROM listings WHERE id = :id";
    $data = $this->db->query($sql, $param);
    $listing = $data->fetch();


    if (! Authorization::isOwner($listing->user_id)) {
      ErrorController::notAuthorize();
      exit;
    }

    if (!$listing) return ErrorController::notFound();
    $authorizeField = ['title', 'description', 'salary', 'requirements', 'benefits', 'company', 'address', 'city', 'state', 'phone', 'email', 'tags'];
    $newListing = array_intersect_key($_POST, array_flip($authorizeField));
    $newListing['user_id'] = Session::get('user')['user_id'];
    $newListing = array_map('sanitize', $newListing);
    $requiredField = ['title', 'description', 'salary', 'requirements', 'company', 'city', 'phone', 'email'];
    $errors = [];
    foreach ($requiredField as $field) {

      if (empty($newListing[$field]) || !Validation::string($newListing[$field])) {
        $errors[$field] = ucfirst($field) . " is required.";
      }
    }
    if (!empty($errors)) {
      loadView('listings/create', [
        'errors' => $errors,
        'data' => (object) $newListing
      ]);
    } else {
      $values = [];
      foreach ($newListing as $key => $value) {
        $values[] = "{$key} = :{$key}";
      }

      $newListing["id"] = $id;
      $valueStr = implode(", ", $values);
      $updateSql = "UPDATE listings SET {$valueStr} WHERE id = :id";
      $this->db->query($updateSql, $newListing);
      Session::setFlushMessage('success_message', 'Update successfully');
      redirect("/listings/{$id}");
    }
  }

  /**
   *
   * Search by keywords/location
   *
   * @return void
   *
   * */


  public function search()
  {
    $keywords = isset($_GET['keywords']) ? $_GET['keywords'] : "";
    $location = isset($_GET['location']) ? $_GET['location'] : "";

    $sql = "SELECT * FROM listings WHERE (title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keywords OR company LIKE :keywords) AND (city LIKE :location OR state LIKE :location)";
    $params = [
      'keywords' => "%{$keywords}%",
      'location' => "%{$location}%"
    ];
    $listings = $this->db->query($sql, $params)->fetchAll();

    loadView('listings/index', [
      'listings' => $listings,
      'keywords' => $keywords,
      'location' => $location
    ]);
  }
}
