<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DWWM Project</title>
  <meta name="author" content="Nicholas Gillespie">
  <meta name="description" content="End of course project. A blog in CRUD format.">
  <meta name="keywords" content="dwwm, blog, crud, ENDEX">
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
        <li><a href="/">home</a></li>
        <li><a href="/contact">contact</a></li>
        <?php if (Auth::isLoggedIn()) : ?>
          <li><a href="/admin/">admin</a></li>
          <li><a class="btn" href="/logout">logout</a></li>
        <?php else : ?>
          <li><a class="btn" href="/login">login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>