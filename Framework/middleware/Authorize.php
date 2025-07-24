<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{

  /**
   *
   * check is user authenticated
   *
   * @return bool
   * */
  public function isAuthenticated()
  {
    return Session::has('user');
  }


  /**
   *
   * handle the user request
   * @param string $role
   * @return bool
   *
   * */

  public function handle($role)
  {
    if ($this->isAuthenticated() && strtolower($role) === 'guest') {
      return redirect('/');
    } elseif (!$this->isAuthenticated() && strtolower($role) === 'auth') {
      return redirect('/auth/login');
    }
  }
}
