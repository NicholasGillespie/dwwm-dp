<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

    $article = Article::getByID($conn, $_GET['id']);

    if (!$article) {
        die("article not found");
    }
} else {
    die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($article->delete($conn)) {

        Url::redirect("/admin/index.php");
    }
}

?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="container stack">
    <h2>Delete article</h2>

    <form method="post" class="flow">
        <p>Are you sure?</p>
        <a role="link" href="article.php?id=<?= $article->id; ?>">Cancel</a>
        <button>Delete</button>
    </form>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>