<?php

require 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $conn = require 'includes/db.php';

  if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {

    Auth::login();

    Url::redirect('/');
  } else {

    $error = "Invalid username or password." . "<br>" . "Access denied.";
  }
}

?>

<!-- header -->
<?php require 'includes/header.php'; ?>


<!-- main -->
<div class="[ container ][ stack ]">
  <h2>Login</h2>

  <form method="post" class="stack">
    <div class="grid">
      <div class="stack">
        <label for="username">Username</label>
        <input class="space-stack:element-small" name="username" id="username" placeholder="Username">
      </div>
      <div class="[ stack ][ space-stack:composition ]">
        <label for="password">Password</label>
        <input class="space-stack:element-small" name="password" id="password" placeholder="Password">
      </div>
    </div>
    <button class="space-stack:composition">Log in</button>

    <?php if (!empty($error)) : ?>
      <p class="text-align:center danger"><?= $error; ?></p>
    <?php endif; ?>
  </form>
</div>


<!-- footer -->
<?php require 'includes/footer.php'; ?>