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
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if ($results === false) {
  echo mysqli_error($conn);
} else {
  $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
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

  <link rel="stylesheet" href="css/index-global.css">
  <link rel="stylesheet" href="css/page/home/index.css">
  <!-- <link rel="stylesheet" href="css/revenge.css"> -->
</head>

<body>

  <!-- header -->
  <div class="[ cover ][ section-header ]">
    <header role="banner" class="[ cluster ][ justify:space-between ]">
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
    <div class="centered">
      <h1>title</h1>
    </div>
    <div>
      <!--  -->
    </div>
  </div>


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
                    <h3><a href="#"><?= $article['title']; ?></a></h3>
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
  <footer class="[ cluster ][ justify:space-between ][ section-footer ]">
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