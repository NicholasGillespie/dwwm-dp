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

  // allocate current value of img file attribute to variable
  $previous_image = $article->image_file;

  if ($article->setImageFile($conn, null)) {

    if ($previous_image) {
      unlink("../uploads/$previous_image");
    }

    Url::redirect("/admin/article.php?id={$article->id}");
  }
}


?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="container stack">
  <h2>Delete article image</h2>

  <?php if ($article->image_file) : ?>
    <img src="/uploads/<?= $article->image_file; ?>">
  <?php endif; ?>

  <form method="post" class="flow">
    <p>Are you sure?</p>
    <a role="link" href="article-update-img.php?id=<?= $article->id; ?>">Cancel</a>
    <button>Delete</button>
  </form>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>