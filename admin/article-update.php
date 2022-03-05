<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

  $article = Article::getByID($conn, $_GET['id']);

  if (!$article) {
    die("article not found");
  }
} else {
  die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $article->title = $_POST['title'];
  $article->content = $_POST['content'];
  $article->published_at = $_POST['published_at'];

  if ($article->update($conn)) {

    Url::redirect("/admin/article.php?id={$article->id}");
  }
}


?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="container stack">
  <h2>Update article</h2>
  <?php require 'includes/article-form.php'; ?>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>