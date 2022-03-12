<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require 'includes/init.php';

$email = '';
$subject = '';
$message = '';
$sent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $errors = [];

  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Please enter a valid email address';
  }

  if ($subject == '') {
    $errors[] = 'Please enter a subject';
  }

  if ($message == '') {
    $errors[] = 'Please enter a message';
  }

  if (empty($errors)) {

    $mail = new PHPMailer(true);

    try {

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'username@gmail.com';
      $mail->Password = 'password';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom('username/sender@gmail.com');
      $mail->addAddress('receiver@gmail.com');
      $mail->addReplyTo($email);
      $mail->Subject = $subject;
      $mail->Body = $message;

      $mail->send();

      $sent = true;
    } catch (Exception $e) {

      $errors[] = $mail->ErrorInfo;
    }
  }
}

?>

<!-- header -->
<?php require 'includes/header.php'; ?>


<!-- main -->
<div class="[ container ][ stack ]">
  <h2>Contact</h2>
  <?php if ($sent) : ?>
    <p>Message sent.</p>
  <?php else : ?>

    <?php if (!empty($errors)) : ?>
      <ul>
        <?php foreach ($errors as $error) : ?>
          <li><?= $error ?></li>
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
      <button class="space-stack:composition">Send</button>
    </form>
  <?php endif; ?>
</div>


<!-- footer -->
<?php require 'includes/footer.php'; ?>