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
    <table class="space-stack:element">
      <thead>
        <th>title</th>
        <th><a href="article-create.php">create article</a></th>
      </thead>
      <tbody>
        <?php foreach ($articles as $article) : ?>
          <tr>
            <td colspan="2">
              <a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
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


<!-- footer -->
<?php require '../includes/footer.php'; ?>