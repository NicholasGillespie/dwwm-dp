<?php

$db_host = "localhost";
$db_name = "dwwm_realisation_dp";
$db_user = "dwwm_realisation_dp";
$db_pass = "123";

$conn = mysqli_connect($db_host, $db_name, $db_pass, $db_user);

if (mysqli_connect_error()) {
  echo mysqli_connect_error();
  exit;
}

$sql = "SELECT * 
        FROM article 
        WHERE id = 1
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if ($results === false) {
  echo mysqli_error($conn);
} else {
  $article = mysqli_fetch_assoc($results);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Title</title>
  <meta name="author" content="Nicholas Gillespie">
  <meta name="description" content="The MDN Web Docs Learning Area aims to provide complete beginners to the Web with all they need to know to get started with developing web sites and applications.">
  <meta name="keywords" content="fill, in, your, keywords, here">

  <link rel="stylesheet" href="css/page/article/index.css">
  <link rel="stylesheet" href="css/index-global.css">
  <!-- <link rel="stylesheet" href="css/revenge.css"> -->
</head>

<body>

  <!-- header -->
  <header role="banner" class="[ cluster ][ justify:space-between ][ section-header-slim ]">
    <img src="" alt="logo">
    <nav>
      <ul role="list" class="cluster">
        <li><a href="#">about</a></li>
        <li><a href="#">blog</a></li>
        <li><a href="#">shop</a></li>
        <li><a href="#">contact</a></li>
      </ul>
    </nav>
  </header>


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
    </main>
  </div>


  <!-- footer -->
  <footer role="contentinfo" class="[ cluster ][ justify:space-between ][ section-footer ]">
    <nav>
      <ul role="list" class="cluster">
        <li><a href="#">about</a></li>
        <li><a href="#">blog</a></li>
        <li><a href="#">shop</a></li>
        <li><a href="#">contact</a></li>
      </ul>
    </nav>
    <div class="box"></div>
  </footer>

</body>

</html>