<?php

require '../includes/init.php';

Auth::requireLogin();

$article = new Article();

$category_ids = [];

$conn = require '../includes/db.php';

$categories = Category::getAll($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $article->title = $_POST['title'];
  $article->content = $_POST['content'];
  $article->published_at = $_POST['published_at'];

  $category_ids = $_POST['category'] ?? [];

  if ($article->create($conn)) {

    $article->setCategories($conn, $category_ids);

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