<?php

namespace App\Controllers;


class ErrorController
{
  /**
   *
   * Route not found error
   *
   * @param string $message
   *
   * return void
   *
   * */
  public static function notFound($message = "Page not found")
  {
    http_response_code(404);
    loadView('error', [
      'status' => '404',
      'message' => $message
    ]);
  }

  /**
   *
   * Route not authorize error
   *
   * @param string $message
   *
   * return void
   *
   * */
  public static function notAuthorize($message = "Not authorize")
  {
    http_response_code(403);
    loadView('error', [
      'status' => '403',
      'message' => $message
    ]);
  }
}
