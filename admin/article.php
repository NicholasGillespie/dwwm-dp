<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
  $article = Article::getWithCategories($conn, $_GET['id']);
} else {
  $article = null;
}

?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="[ container ][ flow ]">
  <?php if ($article) : ?>
    <article class="flow">
      <h2><?= htmlspecialchars($article[0]['title']); ?></h2>

      <?php if (isset($article[0]['published_at'])) : ?>
        <?php $datetime = new DateTime($article[0]['published_at']); ?>
        <time datetime="<?= $datetime->format("Y-m-j"); ?>"><?= $datetime->format("j-M-Y @ G:i"); ?></time>
      <?php endif; ?>

      <?php if ($article[0]['category_name']) : ?>
        <p>Categories:
          <?php foreach ($article as $a) : ?>
            <?= htmlspecialchars($a['category_name']); ?>
          <?php endforeach; ?>
        </p>
      <?php endif; ?>
      <?php if ($article[0]['image_file']) : ?>
        <img class="[ frame ar-16:9 ]" src="/uploads/<?= $article[0]['image_file']; ?>" alt="<?= $article[0]['image_file']; ?>">
      <?php endif; ?>
      <p><?= htmlspecialchars($article[0]['content']); ?></p>
      <a role="link" href="article-update.php?id=<?= $article[0]['id']; ?>">Edit</a>
      <a role="link" href="article-update-img.php?id=<?= $article[0]['id']; ?>">Edit image</a>
      <a role="link" href="article-delete.php?id=<?= $article[0]['id']; ?>">Delete</a>
    </article>
  <?php else : ?>
    <p>Article not found.</p>
  <?php endif; ?>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>