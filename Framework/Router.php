<?php

namespace Framework;

use App\Controllers\ErrorController;
use Framework\Middleware\Authorize;

class Router
{
  protected $routes = [];


  function registerRoute($method, $uri, $action, $role = [])
  {
    [$controller, $controllerMethod] = explode('@', $action);
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod,
      'role' => $role
    ];
  }



  /**
   *
   * Add a GET route
   *
   * @param string $uri
   * @param string $controller
   * @param array $role
   * @return void
   *
   * */

  function get($uri, $controller, $role = [])
  {
    $this->registerRoute("GET", $uri, $controller, $role);
  }


  /**
   *
   * Add a POST route
   *
   * @param string $uri
   * @param string $controller
   * @param array $role
   * @return void
   *
   * */
  function post($uri, $controller, $role = [])
  {
    $this->registerRoute('POST', $uri, $controller, $role);
  }


  /**
   *
   * Add a GET route
   *
   * @param string $uri
   * @param string $controller
   * @param array $role
   * @return void
   *
   * */


  function put($uri, $controller, $role = [])
  {
    $this->registerRoute('PUT', $uri, $controller, $role);
  }


  /**
   *
   * Add a GET route
   *
   * @param string $uri
   * @param string $controller
   * @param array $role
   * @return void
   *
   * */
  function delete($uri, $controller, $role = [])
  {
    $this->registerRoute('DELETE', $uri, $controller, $role);
  }


  /**
   *
   * Route request
   *
   * @param string $uri
   * @param string $method
   *
   * @return void
   * */

  public function router($uri)
  {

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    if ($requestMethod === 'POST' && isset($_POST['_method'])) {
      $requestMethod = strtoupper($_POST['_method']);
    }

    $uriSegments = explode('/', trim($uri, '/'));
    foreach ($this->routes as $route) {
      $routeSegments = explode('/', trim($route['uri'], '/'));
      $match = true;
      if (count($uriSegments) === count($routeSegments) && $requestMethod === strtoupper($route['method'])) {

        $params = [];

        for ($i = 0; $i < count($routeSegments); $i++) {

          if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
            $match = false;
            break;
          }

          if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
            $params[$matches[1]] = $uriSegments[$i];
          }
        }


        if ($match) {

          foreach ($route['role'] as $role) {
            (new Authorize())->handle($role);
          }

          $controller = "App\\Controllers\\" . $route['controller'];
          $method = $route['controllerMethod'];

          $controllerInstance = new $controller();
          $controllerInstance->$method($params);
          return;
        }
      }
    }

    ErrorController::notFound();
  }
}
