<?php

namespace Framework;

class Validation
{

  /**
   *
   * Validate a string
   * @param string  $value
   * @param int $min
   * @param int $max
   * @return bool
   *
   * */

  public static function string($value, $min = 1, $max = INF)
  {
    $value = trim($value);
    $length = strlen($value);

    return $length >= $min && $length <= $max;
  }

  /**
   *
   * Validate email
   * 
   * @param string $email
   * @return mixed
   *
   * */

  public static function email($value)
  {
    $value = trim($value);

    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }

  /**
   *
   * Match two value
   *
   * @param string $val1
   * @param string $val2
   * @return bool
   *
   * */

  public static function match($val1, $val2)
  {
    $val1 = trim($val1);
    $val2 = trim($val2);

    return $val1 === $val2;
  }
}
