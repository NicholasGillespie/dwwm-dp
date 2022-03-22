<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

// $page
// $records_per_page
// $total_articles
$paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($conn));

// $paginator->limit = $records_per_page; 
// $paginator->offset = $records_per_page * ($page - 1);
$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

?>

<!-- header -->
<?php require 'includes/header.php'; ?>


<!-- main -->
<div class="container">
  <div class="sidebar">
    <main class="stack">
      <div class="box">
        <h2>latest news</h2>
      </div>
      <?php if (empty($articles)) : ?>
        <h3>No articles found.</h3>
      <?php else : ?>
        <ul role="list" class="[ grid ][ space-stack:composition ]">
          <?php foreach ($articles as $article) : ?>
            <li>
              <article class="flex:column">
                <div class="[ box ][ flex:column flow ]">
                  <h3><a class="absolute" href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h3>
                  <?php $datetime = new DateTime($article['published_at']); ?>
                  <time datetime="<?= $datetime->format("Y-m-j"); ?>"><?= $datetime->format("j-M-Y"); ?></time>
                  <p><?= htmlspecialchars($article['content']); ?></p>
                </div>
                <?php if ($article['image_file']) : ?>
                  <img class="[ frame ar-16:9 ][ order:-1 ]" src="/uploads/<?= $article['image_file']; ?>" alt="<?= $article['image_file']; ?>">
                <?php endif; ?>
              </article>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <?php require 'includes/pagination.php'; ?>
    </main>
    <aside class="stack">
      <div class="box">
        <h2>sidebar</h2>
      </div>
      <div class="[ box ][ space-stack:composition ]">
        empty
      </div>
    </aside>
  </div>
</div>


<!-- footer -->
<?php require 'includes/footer.php'; ?>