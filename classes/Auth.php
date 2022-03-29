<?php

class Auth
{
  // The session is initiated by session_start() in "includes/init.php"
  // Then to prevent session fixation attack we regenerate_id as $_SESSION['is_logged_in']
  // FYI You can call session elements whatever you like in the sessions array
  public static function login()
  {
    session_regenerate_id(true);
    $_SESSION['is_logged_in'] = true;
  }



  // Checks if a user is logged in or not
  // Used to display, or not, data. i.e. "admin" btn in "includes/header.php"
  public static function isLoggedIn()
  {
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
  }



  // Means to controle access to pages
  // Spits out an "unauthorised" page if !static::isLoggedIn()
  public static function requireLogin()
  {
    if (!static::isLoggedIn()) {
      die("unauthorised");
    }
  }



  // https://www.php.net/manual/en/function.session-destroy.php
  public static function logout()
  {
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();

      setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
      );
    }
    // destroys all the data in the sessions
    session_destroy();
  }
}
