<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

$articles = Article::getAll($conn);

?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="container stack">
  <h2>administration</h2>
  <a href="article-create.php">create article</a>
  <?php if (empty($articles)) : ?>
    <h3>No articles found.</h3>
  <?php else : ?>
    <table>
      <thead>
        <th>title</th>
      </thead>
      <tbody>
        <?php foreach ($articles as $article) : ?>
          <tr>
            <td>
              <a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>