<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
    $article = Article::getByID($conn, $_GET['id']);
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
            <h2><?= htmlspecialchars($article->title); ?></h2>
            <!-- <time datetime="<?= htmlspecialchars($datetime_array[0]); ?>"><?= htmlspecialchars($datetime_array[1]); ?></time> -->
            <p><?= htmlspecialchars($article->content); ?></p>
            <a role="link" href="article-update.php?id=<?= $article->id; ?>">Edit</a>
            <a role="link" href="article-update-img.php?id=<?= $article->id; ?>">Edit image</a>
            <a role="link" href="article-delete.php?id=<?= $article->id; ?>">Delete</a>
        </article>
    <?php else : ?>
        <p>Article not found.</p>
    <?php endif; ?>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>