<?php

namespace Framework;

class Session
{


  /**
   *
   * create session
   * return void
   *
   * */
  public static function create()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  }


  /**
   *
   * get session
   * @param string $key 
   * @return mixed
   *
   * */

  public static function get($key)
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
  }

  /**
   * @param string $key
   * @param mixed $value
   * @return void
   * */

  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  /**
   *
   * check if session exist
   * @param string $key
   * $return bool
   *
   * */
  public static function has($key)
  {
    return isset($_SESSION[$key]);
  }

  /**
   *
   * unset session
   * @param string $key
   * @return void
   * */
  public static function clear($key)
  {
    if (isset($_SESSION[$key])) {
      unset($_SESSION[$key]);
    }
  }

  /**
   *
   * destroy session
   * @return void
   *
   * */

  public static function clearAll()
  {
    session_unset();
    session_destroy();
  }
}
