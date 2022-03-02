<?php

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

$conn = getDB();

if (isset($_GET['id'])) {
  $article = getArticle($conn, $_GET['id']);

  if ($article) {
    $id = $article['id'];
    $title = $article['title'];
    $content = $article['content'];
    $published_at = $article['published_at'];

    $formatted_published_at = str_replace(' ', 'T', $published_at);
    $published_at = substr($formatted_published_at, 0, -3);
  } else {
    die("article not found");
  }
} else {
  die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $sql = "DELETE FROM article 
        WHERE id = ?";

  $stmt = mysqli_prepare($conn, $sql);
  if ($stmt === false) {
    echo mysqli_error($conn);
  } else {

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {

      redirect("/home.php");
    } else {

      echo mysqli_stmt_error($stmt);
    }
  }
}

?>

<!-- header -->
<?php require 'includes/header.php'; ?>

<!-- main -->
<div class="[ container ][ flow ]">
  <h2>Delete article</h2>
  <p>Are you sure ?</p>
  <form method="post">
    <a role="link" href="article.php?id=<?= $article['id'] ?>">Cancel</a>
    <button>Delete</button>
  </form>
</div>

<!-- footer -->
<?php require 'includes/footer.php'; ?>