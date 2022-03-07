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
        <ul role="list" class="grid">
          <?php foreach ($articles as $article) : ?>
            <li>
              <article class="flex:column">
                <div class="[ box ][ flex:column flow ]">
                  <h3><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h3>
                  <!-- <time class="order:-1" datetime="<?= htmlspecialchars($datetime_array[0]); ?>"><?= htmlspecialchars($datetime_array[2]); ?></time> -->
                  <p><?= htmlspecialchars($article['content']); ?></p>
                </div>
                <div class="[ box frame ar-16:9 ][ order:-1 ]"></div>
              </article>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <div class="cluster justify:space-between">
        <?= var_dump($paginator); ?>
        <p>Page ? / <?= $paginator->total_pages; ?></p>
        <nav>
          <ul role="list" class="cluster">
            <?php if ($paginator->previous) : ?>
              <li><a href="?page=<?= $paginator->previous; ?>">previous</a></li>
            <?php else : ?>
            <?php endif; ?>
            <?php if ($paginator->next) : ?>
              <li><a href="?page=<?= $paginator->next; ?>">next</a></li>
            <?php else : ?>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </main>
    <aside class="stack">
      <div class="box">
        <h2>header aside</h2>
      </div>
      <div class="box">
        empty
      </div>
    </aside>
  </div>
</div>


<!-- footer -->
<?php require 'includes/footer.php'; ?>