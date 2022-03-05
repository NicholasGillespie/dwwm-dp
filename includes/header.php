<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My blog</title>
  <link rel="stylesheet" href="/css/root.css">
  <link rel="stylesheet" href="/css/global.css">
  <link rel="stylesheet" href="/css/composition.css">
  <link rel="stylesheet" href="/css/utility.css">

</head>

<body>

  <header role="banner" class="[ cluster ][ justify:space-between ]">
    <a href="/"><img src="" alt="logo"></a>
    <nav>

      <ul role="list" class="cluster">
        <?php if (Auth::isLoggedIn()) : ?>
          <li><a href="/admin/">admin</a></li>
          <li><a href="/logout.php">logout</a></li>
        <?php else : ?>
          <li><a href="/login.php">login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>