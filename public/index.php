<?php
require __DIR__ . "/../vendor/autoload.php";
require_once "../helper.php";

use Framework\Router;

$router = new Router();

$routes = require basePath("routes.php");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->router($uri);
