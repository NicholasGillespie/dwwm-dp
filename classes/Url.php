<?php

class Url
{
  public static function redirect($path)
  {
    // standard way to check if server is using https or http
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
      $protocol = 'https';
    } else {
      $protocol = 'http';
    }
    // $_SERVER['HTTP_HOST'] returns server name 
    // enabling us to redirect to an absolute URL
    header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $path);
    exit;
  }
}
