<?php

namespace Framework;

use Framework\Session;

class Authorization
{

  /**
   *
   * check current user is own the resourch
   *
   * @param int @resourceId
   * @return bool
   *
   * */

  public static function isOwner($resourceId)
  {
    if (Session::has('user')) {
      $userId = (int) Session::get('user')['user_id'];
      return $userId === $resourceId;
    }
    return false;
  }
}
