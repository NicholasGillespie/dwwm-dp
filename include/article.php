<?php

function getArticle($conn, $id, $specific_columns = "*")
{
  $sql = "SELECT $specific_columns
          FROM article
          WHERE id = ?";

  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt === false) {
    echo mysqli_error($conn);
  } else {
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);
      return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
  }
}


function validateArticle($title, $content, $published_at, $verify_published_at)
{
  $errors = [];

  if ($title == '') {
    $errors[] = 'Title is required';
  }
  if ($content == '') {
    $errors[] = 'Content is required';
  }
  if ($published_at == '') {
    $errors[] = 'Invalid date and time';
  }

  if ($published_at != '') {
    $date_time = date_create_from_format('Y-m-d H:i:s', $verify_published_at);

    if ($date_time === false) {
      $errors[] = 'Invalid date and time';
    } else {
      $date_errors = date_get_last_errors();

      if ($date_errors['warning_count'] > 0) {
        $errors[] = 'Invalid date and time';
      }
    }
  }
  return $errors;
}



function getDateTime($article)
{
  if (isset($article)) {
    $date = substr($article['published_at'], 0, 10);

    $day = substr($date, -2);
    $month = substr($date, -5, -3);
    $year = substr($date, 0, -6);
    $time = substr($article['published_at'], 11, -3);
    $julian_day = gregoriantojd($month, $day, $year);
    $month_written = jdmonthname($julian_day, CAL_MONTH_GREGORIAN_SHORT);
    $datetime_front = $day . "-" . $month_written . "-" . $year . ", " . $time;
    $date_front = $day . "-" . $month_written . "-" . $year;
    $datetime_array = [$date, $datetime_front, $date_front];
  }
  return $datetime_array;
}
