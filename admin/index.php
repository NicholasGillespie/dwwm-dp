<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 10, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="container stack">
  <div>
    <h2>administration</h2>
  </div>
  <?php if (empty($articles)) : ?>
    <h3>No articles found.</h3>
  <?php else : ?>

    <div class="[ box cluster ][ justify:space-between ][ tablehead ]">
      <h2>title</h2>
      <a href="article-create">create article</a>
    </div>
    <?php foreach ($articles as $article) : ?>
      <div class="[ box cluster ][ justify:space-between ]">
        <a class="absolute" href="article?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a>

        <?php if (isset($article['published_at'])) : ?>
          <?php $datetime = new DateTime($article['published_at']); ?>
          <time datetime="<?= $datetime->format("Y-m-j"); ?>"><?= $datetime->format("j-M-Y @ G:i"); ?></time>
        <?php endif; ?>

      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <?php require '../includes/pagination.php'; ?>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>