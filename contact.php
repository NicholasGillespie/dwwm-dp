<?php

require 'includes/init.php';

$email = "";
$subject = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $errors = [];

  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Please enter a valid email address';
  }
  if ($subject == "") {
    $errors[] = 'Please enter a subject';
  }
  if ($message == "") {
    $errors[] = 'Please enter a message';
  }

  if (empty($errors)) {
    # code...
  }
}

?>

<!-- header -->
<?php require 'includes/header.php'; ?>


<!-- main -->
<div class="[ container ][ stack ]">
  <h2>Contact</h2>

  <?php if (!empty($errors)) : ?>
    <ul>
      <?php foreach ($errors as $error) : ?>
        <li><?= $error; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form method="post" class="stack">
    <div class="grid">
      <div class="stack">
        <label for="email">Your email</label>
        <input class="space-stack:element-small" type="email" name="email" id="email" placeholder="Your email" value="<?= htmlspecialchars($email); ?>">
      </div>
      <div class="[ stack ][ space-stack:composition ]">
        <label for="subject">Subject</label>
        <input class="space-stack:element-small" name="subject" id="subject" placeholder="Subject" value="<?= htmlspecialchars($subject); ?>">
      </div>
    </div>
    <div class="[ stack ][ space-stack:composition ]">
      <label for="content">Message</label>
      <textarea class="space-stack:element-small" name="message" rows="4" cols="40" id="message" placeholder="Message"><?= htmlspecialchars($message); ?></textarea>
    </div>
    <button class="space-stack:composition">Log in</button>
  </form>
</div>


<!-- footer -->
<?php require 'includes/footer.php'; ?>