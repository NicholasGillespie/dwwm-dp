<?php

require 'include/database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $sql = "SELECT * 
        FROM article 
        WHERE id = " . $_GET['id'];

  $results = mysqli_query($conn, $sql);

  if ($results === false) {
    echo mysqli_error($conn);
  } else {
    $article = mysqli_fetch_assoc($results);
  }
} else {
  $article = null;
}

?>

<!-- header -->
<?php require 'include/tpl/tpl-header-global.php'; ?>

<!-- main -->
<div class="[ container ][ section-main ]">
  <main class="stack">
    <?php if ($article === null) : ?>
      <h3>No articles found.</h3>
    <?php else : ?>
      <article class="flex">
        <div class="[ flow ][ article__content ]">
          <h2><?= $article['title']; ?></h2>
          <time datetime="2018-07-07"><?= $article['published_at']; ?></time>
          <div class="[ frame ar-16:9 ]"></div>
          <p><?= $article['content']; ?></p>
        </div>
      </article>
    <?php endif; ?>
    <ul role="list" class="[ cluster ][ paginator ]">
      <li><a href="article.php?id=<?= $_GET['id'] - 1 ?>">previous</a></li>
      <li><a href="article.php?id=<?= $_GET['id'] + 1 ?>">next</a></li>
    </ul>
  </main>
</div>


<!-- footer -->
<?php require 'include/tpl/tpl-footer.php'; ?>