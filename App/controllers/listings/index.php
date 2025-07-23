<?php

$config = require basePath("config/db.php");
$db = new Database($config);
$sql = "SELECT * FROM listings";
$listings = $db->query($sql)->fetchAll();
loadView("listings/index", [
  'listings' => $listings
]);
