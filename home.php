<?php

require 'include/database.php';

$sql = "SELECT * 
        FROM article 
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if ($results === false) {
  echo mysqli_error($conn);
} else {
  $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

?>

<!-- header -->
<?php require 'include/tpl/tpl-header-home.php'; ?>

<!-- main -->
<div class="[ container ][ section-main ]">
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
                <div class="[ box ][ flow flex:column ][ article__content ]">
                  <h3><a href="article.php?id=<?= $article['id']; ?>"><?= $article['title']; ?></a></h3>
                  <time class="order:-1" datetime="2018-07-07"><?= $article['published_at']; ?></time>
                  <p><?= $article['content']; ?></p>
                </div>
                <div class="[ box frame ar-16:9 ][ order:-1 ]"></div>
                <span class="article__label">test</span>
              </article>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <ul role="list" class="[ cluster ][ paginator ]">
        <li><a href="#">previous</a></li>
        <li><a href="#">next</a></li>
      </ul>
    </main>
    <aside class="stack">
      <div class="box">
        <h2>header aside</h2>
      </div>
      <div class="box">
        <!--  -->
      </div>
    </aside>
  </div>
</div>

<!-- footer -->
<?php require 'include/tpl/tpl-footer.php'; ?>