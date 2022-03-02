<?php

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

$title = '';
$content = '';
$published_at = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title = $_POST['title'];
  $content = $_POST['content'];
  $published_at = $_POST['published_at'];
  $verify_published_at = str_replace('T', ' ', $published_at) . ":00";

  $errors = validateArticle($title, $content, $published_at, $verify_published_at);

  if (empty($errors)) {

    $conn = getDB();

    $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
      echo mysqli_error($conn);
    } else {

      if ($published_at == '') {
        $published_at = null;
      }

      mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

      if (mysqli_stmt_execute($stmt)) {

        $id = mysqli_insert_id($conn);

        redirect("/article.php?id=$id");
      } else {

        echo mysqli_stmt_error($stmt);
      }
    }
  }
}

?>

<!-- header -->
<?php require 'includes/header.php'; ?>

<!-- main -->
<div class="container stack">
  <h2>Create article</h2>
  <?php require 'includes/article-form.php'; ?>
</div>

<!-- footer -->
<?php require 'includes/footer.php'; ?>