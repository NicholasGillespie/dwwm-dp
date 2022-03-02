<?php

require 'includes/database.php';
require 'includes/article.php';

$conn = getDB();

if (isset($_GET['id'])) {
  $article = getArticle($conn, $_GET['id']);

  $datetime_array = getDateTime($article);
} else {
  $article = null;
}

?>

<!-- header -->
<?php require 'includes/header.php'; ?>

<!-- main -->
<div class="[ container ][ flow ]">
  <?php if ($article === null) : ?>
    <p>Article not found.</p>
  <?php else : ?>
    <article class="flow">
      <h2><?= htmlspecialchars($article['title']); ?></h2>
      <time datetime="<?= htmlspecialchars($datetime_array[0]); ?>"><?= htmlspecialchars($datetime_array[1]); ?></time>
      <p><?= htmlspecialchars($article['content']); ?></p>
      <a role="link" href="article-update.php?id=<?= $article['id'] ?>">Edit</a>
      <a role="link" href="article-delete.php?id=<?= $article['id'] ?>">Delete</a>
    </article>
  <?php endif; ?>
</div>

<!-- footer -->
<?php require 'includes/footer.php'; ?>