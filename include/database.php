<?php

function getDB()
{
  $db_host = "localhost";
  $db_name = "dwwm_realisation_dp";
  $db_user = "dwwm_realisation_dp";
  $db_pass = "123";

  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

  if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
  }
  return $conn;
}
