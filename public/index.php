<?php
require __DIR__ . "/../vendor/autoload.php";

use Framework\Router;
use Framework\Session;

Session::create();



require_once "../helper.php";
$router = new Router();

$routes = require basePath("routes.php");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->router($uri);
