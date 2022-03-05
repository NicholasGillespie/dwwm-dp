<?php

require '../includes/init.php';

Auth::requireLogin();

$article = new Article();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $conn = require '../includes/db.php';

  $article->title = $_POST['title'];
  $article->content = $_POST['content'];
  $article->published_at = $_POST['published_at'];

  if ($article->create($conn)) {

    Url::redirect("/admin/article.php?id={$article->id}");
  }
}

?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="container stack">
  <h2>Create article</h2>
  <?php require 'includes/article-form.php'; ?>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>